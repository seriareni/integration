<?php

namespace App\Http\Controllers;

use App\Models\File;
use GuzzleHttp\Psr7\FnStream;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Collection;
use phpDocumentor\Reflection\Types\Integer;
use Zip;
use Validator;
use GuzzleHttp\Client;
use GuzzleHttp\Middleware;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Pacuna\Schemas\Facades\PGSchema;

class ZipController extends Controller
{
    //
    public function index()
    {
        $schemas = DB::select("SELECT schema_name FROM information_schema.schemata where schema_name not like 'information_schema' and schema_name not like 'pg_%' and schema_name not like 'public'");
        return view('backend/upload_data', ['schemas' => $schemas]);
    }

    public function deleteDirectory($dir)
    {
        if (!file_exists($dir)) {
            return true;
        }
        if (!is_dir($dir)) {
            return unlink($dir);
        }
        foreach (scandir($dir) as $item) {
            if ($item == '.' || $item == '..') {
                continue;
            }
            if (!$this->deleteDirectory($dir . DIRECTORY_SEPARATOR . $item)) {
                return false;
            }
        }
        return rmdir($dir);
    }

    public function uploadData(Request $request)
    {
        $schema = Input::get('data');
        $schemaName = str_replace(" ", "_", $schema);
        $schemaNameNew = $schemaName;
        $uploadedFile = $request->file('zip_file');
        $zipName = time() . '_' . $uploadedFile->getClientOriginalName();
        $uploadedFile->move('uploads/', $zipName);

        $zip = Zip::open(public_path('uploads/' . $zipName));
//      $zip->extract(public_path().'uploads\\'.time().$uploadedFile->getClientOriginalName());
        $filenameZip = public_path('uploads/' . time() . $uploadedFile->getClientOriginalName());
        $zip->extract($filenameZip);
        $zip->close();

//      Menghapus file zip pada public
        unlink(public_path() . '\\uploads\\' . $zipName);

//      dd(glob($filenameZip . "/*.prj"));
        foreach (glob($filenameZip . "/*.prj") as $filename) {
            $file_prj = str_replace("/", "\\", $filename);
        }

        $epsg = (int) shell_exec("python C:\Users\USER\Documents\Python\getEPSG.py ".$file_prj);

        // globe-> mengambil isi dari folder yang dipilih
        foreach (glob($filenameZip . "/*.shp") as $filename) {
            $filename_new = str_replace("/", "\\", $filename);
            $table_name = basename($filename_new, ".shp");
            $table_name_new = str_replace(" ", "_", $table_name);
        }

//      here 4326 is spatial reference system or coordinate system of the shape file.
        shell_exec('"C:\Program Files\PostgreSQL\9.5\bin\shp2pgsql" -I -s '. $epsg .' '. $filename_new . ' ' . $schemaNameNew . '.' . $table_name_new . ' | "C:\Program Files\PostgreSQL\9.5\bin\psql" -U postgres -d sitrg');

        $this->deleteDirectory($filenameZip);
        $this->request_workspace($schemaName);
        $this->post_store($schemaName);

        shell_exec("python C:\Users\USER\Documents\Python\publishLayer.py ". $schemaName .' '. $table_name .' '. $epsg);

        return redirect('backend/uploadData');
    }

    public function post_workspace(String $name)
    {
        $client = new Client();
        $res = $client->request('POST', 'http://localhost:8080/geoserver/rest/workspaces', [
            'auth' => ['admin', 'geoserver'],
            'json' => [
                'workspace' => [
                    'name' => $name
                ]
            ]
        ]);
    }

    public function request_workspace(String $name)
    {
        $client = new Client();
        $res = $client->request('GET', 'http://localhost:8080/geoserver/rest/workspaces/', [
            'auth' => ['admin', 'geoserver']
        ]);
//      menampilkan json
//      dd((string) $res->getBody());

        $responsArray = json_decode($res->getBody());

        foreach ($responsArray->workspaces as $num => $item) {
            foreach ($item as $no => $piece) {
                echo "workspace:";
                 $resultname = $piece->name;
                echo $resultname."<br>";

                echo "input:". $name."<br>";

                if ($name == $resultname){
                    $result=1;
                    break;
                    }
                else{
                    $result=0;
                }
            }
            if ($result==0) {
                $this->post_workspace($name);
            }
//            else
//                $this->put_workspace($name);

            $workspacename=$name;
        }
    }

    public function post_store(String $name)
    {
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, "http://localhost:8080/geoserver/rest/workspaces/". $name ."/datastores");
        curl_setopt($ch, CURLOPT_HTTPHEADER,  array("Content-type: application/xml", 'Authorization: Basic YWRtaW46Z2Vvc2VydmVy'));
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, "<dataStore>
                                                            <name>".$name."</name>
                                                            <connectionParameters>
                                                            <SPI>org.geotools.data.postgis.PostgisNGDataStoreFactory</SPI>
                                                            <host>localhost</host>
                                                            <port>5432</port>
                                                            <database>sitrg</database>
                                                            <schema>".$name."</schema>
                                                            <user>postgres</user>
                                                            <passwd>postgres</passwd>
                                                            <bbox>true</bbox>
                                                            <extends>false</extends>
                                                            <connections>true</connections>
                                                            <timeout>300</timeout>
                                                            <preparedStatements>true</preparedStatements>
                                                            <dbtype>postgis</dbtype>
                                                            </connectionParameters></dataStore>");
        curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );

        $str = curl_exec($ch);

        curl_close($ch);

    }

    public function publish(String $name, String $shpname, Integer $epsg)
    {
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, "http://localhost:8080/geoserver/rest/workspaces/". $name ."/datastores/". $name ."/featuretypes/". $shpname ."");
        curl_setopt($ch, CURLOPT_HTTPHEADER,  array("Content-type: application/xml", 'Authorization: Basic YWRtaW46Z2Vvc2VydmVy'));
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");

        curl_setopt($ch, CURLOPT_POSTFIELDS, "<featureType>
                                                          <name>". $shpname ."</name>
                                                          <nativeName>". $shpname ."</nativeName>
                                                          <title>Annotations</title>
                                                          <srs>EPSG:". $epsg ."</srs>
                                                          <attributes>
                                                            <attribute>
                                                              <name>the_geom</name>
                                                              <binding>org.locationtech.jts.geom.Point</binding>
                                                            </attribute>
                                                            <attribute>
                                                              <name>description</name>
                                                              <binding>java.lang.String</binding>
                                                            </attribute>
                                                            <attribute>
                                                              <name>timestamp</name>
                                                              <binding>java.util.Date</binding>
                                                            </attribute>
                                                          </attributes>
                                                        </featureType>");
        curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
        $str = curl_exec($ch);

        curl_close($ch);
    }

    public function feature_store(String $name, String $shpname)
    {
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, "http://localhost:8080/geoserver/rest/workspaces/". $name ."/datastores/". $name ."/featuretypes/". $shpname ."");
        curl_setopt($ch, CURLOPT_HTTPHEADER,  array("Content-type: application/xml", 'Authorization: Basic YWRtaW46Z2Vvc2VydmVy'));
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, "<FeatureTypeInfo>
                                                        <name>". $shpname ."</name>
                                                        <nativeName>". $shpname ."</nativeName>
                                                        <namespace>
                                                            <name>". $shpname ."</name>
                                                        </namespace>
                                                        <title>Manhattan (NY) points of interest</title>
                                                        <abstract>Points of interest in New York, New York (on Manhattan). One of the attributes contains the name of a file with a picture of the point of interest.</abstract>
                                                        <keywords>
                                                            <string>". $shpname ."</string>
                                                            <string>Manhattan</string>
                                                            <string>DS_poi</string>
                                                            <string>points_of_interest</string>
                                                            <string>sampleKeyword\@language=ab\;</string>
                                                            <string>area of effect\@language=bg\;\@vocabulary=technical\;</string>
                                                            <string>Привет\@language=ru\;\@vocabulary=friendly\;</string>
                                                        </keywords>
                                                        <metadatalinks>
                                                            <metadataLink>
                                                                <type>string</type>
                                                                <metadataType>string</metadataType>
                                                                <content>string</content>
                                                            </metadataLink>
                                                        </metadatalinks>
                                                        <dataLinks>
                                                            <metadataLink>
                                                                <type>string</type>
                                                                <content>string</content>
                                                            </metadataLink>
                                                        </dataLinks>
                                                        <nativeCRS>GEOGCS[&quot;WGS 84&quot;, 
                                                      DATUM[&quot;World Geodetic System 1984&quot;, 
                                                        SPHEROID[&quot;WGS 84&quot;, 6378137.0, 298.257223563, AUTHORITY[&quot;EPSG&quot;,&quot;7030&quot;]], 
                                                        AUTHORITY[&quot;EPSG&quot;,&quot;6326&quot;]], 
                                                      PRIMEM[&quot;Greenwich&quot;, 0.0, AUTHORITY[&quot;EPSG&quot;,&quot;8901&quot;]], 
                                                      UNIT[&quot;degree&quot;, 0.017453292519943295], 
                                                      AXIS[&quot;Geodetic longitude&quot;, EAST], 
                                                      AXIS[&quot;Geodetic latitude&quot;, NORTH], 
                                                      AUTHORITY[&quot;EPSG&quot;,&quot;4326&quot;],
                                                      PROJECTION[&quot;Transverse_Mercator&quot;], &#xd;
                                                      PARAMETER[&quot;central_meridian&quot;, 111.0], &#xd;
                                                      PARAMETER[&quot;latitude_of_origin&quot;, 0.0], &#xd;
                                                      PARAMETER[&quot;scale_factor&quot;, 0.9996], &#xd;
                                                      PARAMETER[&quot;false_easting&quot;, 500000.0], &#xd;
                                                      PARAMETER[&quot;false_northing&quot;, 10000000.0], &#xd;
                                                      UNIT[&quot;m&quot;, 1.0], &#xd;
                                                      AXIS[&quot;Easting&quot;, EAST], &#xd;
                                                      AXIS[&quot;Northing&quot;, NORTH], &#xd;
                                                      AUTHORITY[&quot;EPSG&quot;,&quot;4326&quot;]]]</nativeCRS>
                                                        <srs>EPSG:4326</srs>
                                                        <nativeBoundingBox>
                                                            <minx>-74.0118315772888</minx>
                                                            <maxx>-74.00153046439813</maxx>
                                                            <miny>40.70754683896324</miny>
                                                            <maxy>40.719885123828675</maxy>
                                                            <crs>EPSG:4326</crs>
                                                        </nativeBoundingBox>
                                                        <latLonBoundingBox>
                                                            <minx>-74.0118315772888</minx>
                                                            <maxx>-74.00857344353275</maxx>
                                                            <miny>40.70754683896324</miny>
                                                            <maxy>40.711945649065406</maxy>
                                                            <crs>EPSG:4326</crs>
                                                        </latLonBoundingBox>
                                                        <metadata>
                                                            <@key>regionateStrategy</@key>
                                                            <$>string</$>
                                                        </metadata>
                                                        <store>
                                                            <@class>dataStore</@class>
                                                            <name>". $shpname .":nyc</name>
                                                            <href>http://localhost:8080/geoserver/rest/workspaces/". $shpname ."/datastores/". $shpname ."</href>
                                                        </store>
                                                        <cqlFilter>INCLUDE</cqlFilter>
                                                        <maxFeatures>100</maxFeatures>
                                                        <numDecimals>6</numDecimals>
                                                        <responseSRS>
                                                            <string>
                                                                <0>4326</0>
                                                            </string>
                                                        </responseSRS>
                                                        <overridingServiceSRS>true</overridingServiceSRS>
                                                        <skipNumberMatched>true</skipNumberMatched>
                                                        <circularArcPresent>true</circularArcPresent>
                                                        <linearizationTolerance>10</linearizationTolerance>
                                                        <attributes>
                                                            <attribute>
                                                                <name>the_geom</name>
                                                                <minOccurs>0</minOccurs>
                                                                <maxOccurs>1</maxOccurs>
                                                                <nillable>true</nillable>
                                                                <binding>org.locationtech.jts.geom.Point</binding>
                                                                <length>0</length>
                                                            </attribute>
                                                            <attribute>
                                                                <name>the_geom</name>
                                                                <minOccurs>0</minOccurs>
                                                                <maxOccurs>1</maxOccurs>
                                                                <nillable>true</nillable>
                                                                <binding>org.locationtech.jts.geom.Point</binding>
                                                                <length>0</length>
                                                            </attribute>
                                                            <attribute>
                                                                <name>the_geom</name>
                                                                <minOccurs>0</minOccurs>
                                                                <maxOccurs>1</maxOccurs>
                                                                <nillable>true</nillable>
                                                                <binding>org.locationtech.jts.geom.Point</binding>
                                                                <length>0</length>
                                                            </attribute>
                                                            <attribute>
                                                                <name>the_geom</name>
                                                                <minOccurs>0</minOccurs>
                                                                <maxOccurs>1</maxOccurs>
                                                                <nillable>true</nillable>
                                                                <binding>org.locationtech.jts.geom.Point</binding>
                                                                <length>0</length>
                                                            </attribute>
                                                        </attributes>
                                                    </FeatureTypeInfo>");


        curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
        $str = curl_exec($ch);

        curl_close($ch);
    }

    public function coba()
    {
        PGSchema::create('Percobaan');

//        $nama = "data";
//        $this->request_workspace($nama);
//
//        $datastore = new \SimpleXMLElement('<dataStore></dataStore>');
//
//        $data = $datastore->asXML();
//
//        $datajson=[
//            'dataStore' => [
//                'name' => 'test',
//                'connectionParameter' => [
//                    'entry' => [
//                        ['@key' => 'host', '$' => 'localhost'],
//                        ['@key' => 'port', '$' => 5432],
//                        ['@key' => 'database', '$' => 'sitrg'],
//                        ['@key' => 'user', '$' => 'postgres'],
//                        ['@key' => 'passwd', '$' => 'postgres'],
//                        ['@key' => 'dbtype', '$' => 'postgis'],
//                    ]
//                ]
//            ]
//        ];

//        $encode=json_encode($data);
//
//        $ch = curl_init();
//
//        curl_setopt($ch, CURLOPT_URL, "http://localhost:8080/geoserver/rest/workspaces/". $nama ."/datastores");
//        curl_setopt($ch, CURLOPT_HTTPHEADER,  array("Content-type: application/xml", 'Authorization: Basic YWRtaW46Z2Vvc2VydmVy'));
//        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
//        curl_setopt($ch, CURLOPT_POSTFIELDS, "<dataStore>
//                                                            <name>".$nama."</name>
//                                                            <connectionParameters>
//                                                            <host>localhost</host>
//                                                            <port>5432</port>
//                                                            <database>sitrg</database>
//                                                            <user>admin</user>
//                                                            <passwd>postgres</passwd>
//                                                            <dbtype>postgis</dbtype>
//                                                            </connectionParameters></dataStore>");
//        curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
//
//        $str = curl_exec($ch);
//
//        curl_close($ch);
//
//        // the value of $str is actually bool(true), not empty string ''
//        dd($str);


//        $this->request_workspace();
//        $a = glob(public_path().'/uploads/1542184016SBYkecamatan_Populasi.zip'."/*.shp");
//        "D:\XAMPP\htdocs\sitrg\public/uploads/1542184016SBYkecamatan_Populasi.zip/SBYkecamatan_Populasi.shp"

//        $schemas = shell_exec('"C:\Program Files\PostgreSQL\9.5\bin\psql" -U postgres -d sitrg -c "\dn"');
//        dd($schemas);
//        $schemas = ['aa','ab'];

//        $coba = shell_exec('"C:\Program Files\PostgreSQL\9.5\bin\psql" -U postgres -d sitrg -c "SELECT schema_name FROM information_schema.schemata;"');
//
//        $coba = DB::select('SELECT schema_name FROM information_schema.schemata');
//        $coba2 = DB::select("SELECT schema_name FROM information_schema.schemata where schema_name not like 'information_schema' and schema_name not like 'pg_%'");
//        dd($coba2);

//
//        return view('backend/test');

    }

    public function show(Request $request)
    {
        return view('backend/data_shp');
    }
}
