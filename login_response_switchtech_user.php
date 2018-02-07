<?php 
echo $data = '{
  "switches": [
    {
      "switch_unid": "054342599CCEB2ACF2541D5C16A5A1F3",
      "switch_name": "Duff Drive",
      "latitude": "39.30942500",
      "longitude": "-84.44885600",
      "switch_clli": "CNCQOH22CM1",
      "switch_callout_zone": "SWITCH_Duff",
      "area": "Great Lakes",
      "region": "OPW",
      "market": "Ohio",
      "remedy_switch": "DUFF DR",
      "remedy_switch2": "",
      "remedy_switch3": "",
      "remedy_switch4": "",
      "switch_xing_id": 90762,
      "switch_emis_id": "7578345",
      "switch_network_id": 2872513,
      "emis_lastverifiedon": "",
      "emis_nextverification": "",
      "emis_verification": "none",
      "emis_tooltip": "",
      "emis_lastverifiedby": "",
      "env_alarm_icon": "no",
      "techs": [
        {
          "userid": "akersja",
          "name": "Jason Akers"
        },
        {
          "userid": "anclaan",
          "name": "Anthony Anclard"
        },
        {
          "userid": "bostda2",
          "name": "Darwin Bostick"
        },
        {
          "userid": "burriwe",
          "name": "Wesley Burris"
        },
        {
          "userid": "cutteda",
          "name": "Dana Cutter"
        },
        {
          "userid": "davjo16",
          "name": "Joey Davis"
        },
        {
          "userid": "kaspda1",
          "name": "David Kasper"
        },
        {
          "userid": "lewida6",
          "name": "David Lewis"
        },
        {
          "userid": "logwoli",
          "name": "Lillian Logwood"
        },
        {
          "userid": "patrra1",
          "name": "Randy Patrick"
        },
        {
          "userid": "trenan1",
          "name": "Angela Trent"
        },
        {
          "userid": "v790975",
          "name": "Peter Mayer"
        }
      ],
      "mgrs": [
        {
          "userid": "clar1wa",
          "name": "Walter Clark"
        }
      ]
    },
    {
      "switch_unid": "91EC711719D8864FB0774CEBD5136C34",
      "switch_name": "Duff Drive 2",
      "latitude": "38.65194444",
      "longitude": "-83.74555556",
      "switch_clli": "CNCQOH22CM2",
      "switch_callout_zone": "SWITCH_Duff",
      "area": "Great Lakes",
      "region": "OPW",
      "market": "Ohio",
      "remedy_switch": "DUFF 2_MTX",
      "remedy_switch2": "DUFF DR 2 1",
      "remedy_switch3": "DUFF DR 2 2",
      "remedy_switch4": "LEWIS CENTER_BSM_11",
      "switch_xing_id": 90762,
      "switch_emis_id": "3337364",
      "switch_network_id": null,
      "emis_lastverifiedon": "2018-01-19",
      "emis_nextverification": "",
      "emis_verification": "none",
      "emis_tooltip": "",
      "emis_lastverifiedby": "nelsoer",
      "env_alarm_icon": "no",
      "techs": [
        {
          "userid": "akersja",
          "name": "Jason Akers"
        },
        {
          "userid": "anclaan",
          "name": "Anthony Anclard"
        },
        {
          "userid": "bostda2",
          "name": "Darwin Bostick"
        },
        {
          "userid": "burriwe",
          "name": "Wesley Burris"
        },
        {
          "userid": "cutteda",
          "name": "Dana Cutter"
        },
        {
          "userid": "davjo16",
          "name": "Joey Davis"
        },
        {
          "userid": "kaspda1",
          "name": "David Kasper"
        },
        {
          "userid": "lewida6",
          "name": "David Lewis"
        },
        {
          "userid": "logwoli",
          "name": "Lillian Logwood"
        },
        {
          "userid": "patrra1",
          "name": "Randy Patrick"
        },
        {
          "userid": "trenan1",
          "name": "Angela Trent"
        },
        {
          "userid": "v790975",
          "name": "Peter Mayer"
        }
      ],
      "mgrs": [
        {
          "userid": "clar1wa",
          "name": "Walter Clark"
        }
      ]
    }
  ]
}';
?> 
<?php
/*
curl -X GET --header 'Accept: application/json' --header 'Authorization: Bearer 45ca85df-a619-3a65-8d63-ab24cc56f173' 'https://nssapigateway.vh.vzwnet.com/iop/switchbytech/v1.0.0/switch/tech/cutteda'
*/
/*
echo 'Inside the routerbytechAPI file';

$opts = array(
  'http'=>array(
    'method'=>"GET",
    'header'=>"Accept-language: en\r\n" .
             // "Cookie: foo=bar\r\n" .
             // "User-agent: BROWSER-DESCRIPTION-HERE\r\n"
              "Authorization: Bearer 45ca85df-a619-3a65-8d63-ab24cc56f173\r\n"
  )
);
$context = stream_context_create($opts);
// Open the file using the HTTP headers set above
$output = file_get_contents('https://nssapigateway.vh.vzwnet.com/iop/switchbytech/v1.0.0/switch/tech/cutteda', false, $context);
//$output = json_decode($output):
echo '<br>'."Results below".'<br>';
print_r($output);
echo '<br>'."Results are as below".'<br>';
*/
/*
foreach($output as  $value) {
echo "<br>". "Key and values"."<br>";
echo $value->switches;
};
*/

/*
Sample json response is given as below.
{
  "switches": [
    {
      "switch_unid": "B0D9F5C742C431667013FA906E6EFFE1",
      "switch_name": "Cincinnati",
      "latitude": "39.11172500",
      "longitude": "-84.52029200",
      "switch_clli": "CNCNOHSM",
      "switch_callout_zone": "SWITCH_DUFF",
      "area": "Great Lakes",
      "region": "OPW",
      "market": "Ohio",
      "remedy_switch": "CINCINNATI_BSM_1",
      "remedy_switch2": "CINCINNATI_BSM_2",
      "remedy_switch3": "CINCINNATI_MTX",
      "remedy_switch4": "CNCQOH22_021_BSM",
      "switch_xing_id": 69512,
      "switch_emis_id": "80284",
      "switch_network_id": null,
      "emis_lastverifiedon": "2015-11-05",
      "emis_nextverification": "",
      "emis_verification": "none",
      "emis_tooltip": "",
      "emis_lastverifiedby": "nelsoer",
      "env_alarm_icon": "no",
      "techs": [
        {
          "userid": "anclaan",
          "name": "Anthony Anclard"
        },
        {
          "userid": "cutteda",
          "name": "Dana Cutter"
        }
      ],
      "mgrs": [
        {
          "userid": "clar1wa",
          "name": "Walter Clark"
        }
      ]
    },
    {
      "switch_unid": "64D314D00DA7A487B3072D73694A7AAC",
      "switch_name": "COLUMBUS",
      "latitude": "39.96838900",
      "longitude": "-82.99516700",
      "switch_clli": "CLMBOHIQ",
      "switch_callout_zone": "SWITCH_CENTRAL_OHIO",
      "area": "Great Lakes",
      "region": "OPW",
      "market": "Ohio",
      "remedy_switch": "COLUMBUS_BSM_0",
      "remedy_switch2": "COLUMBUS_OH_MTX",
      "remedy_switch3": "",
      "remedy_switch4": "",
      "switch_xing_id": 69895,
      "switch_emis_id": "80399",
      "switch_network_id": null,
      "emis_lastverifiedon": "2016-12-08",
      "emis_nextverification": "",
      "emis_verification": "none",
      "emis_tooltip": "",
      "emis_lastverifiedby": "clar1wa",
      "env_alarm_icon": "no",
      "techs": [
        {
          "userid": "akersja",
          "name": "Jason Akers"
        },
        {
          "userid": "anclaan",
          "name": "Anthony Anclard"
        },
        {
          "userid": "bostda2",
          "name": "Darwin Bostick"
        },
        {
          "userid": "burriwe",
          "name": "Wesley Burris"
        },
        {
          "userid": "cutteda",
          "name": "Dana Cutter"
        },
        {
          "userid": "davjo16",
          "name": "Joey Davis"
        },
        {
          "userid": "kaspda1",
          "name": "David Kasper"
        },
        {
          "userid": "lewida6",
          "name": "David Lewis"
        },
        {
          "userid": "logwoli",
          "name": "Lillian Logwood"
        },
        {
          "userid": "patrra1",
          "name": "Randy Patrick"
        },
        {
          "userid": "trenan1",
          "name": "Angela Trent"
        },
        {
          "userid": "v790975",
          "name": "Peter Mayer"
        }
      ],
      "mgrs": [
        {
          "userid": "clar1wa",
          "name": "Walter Clark"
        }
      ]
    },
    {
      "switch_unid": "054342599CCEB2ACF2541D5C16A5A1F3",
      "switch_name": "Duff Drive",
      "latitude": "39.30942500",
      "longitude": "-84.44885600",
      "switch_clli": "CNCQOH22CM1",
      "switch_callout_zone": "SWITCH_Duff",
      "area": "Great Lakes",
      "region": "OPW",
      "market": "Ohio",
      "remedy_switch": "DUFF DR",
      "remedy_switch2": "",
      "remedy_switch3": "",
      "remedy_switch4": "",
      "switch_xing_id": 90762,
      "switch_emis_id": "7578345",
      "switch_network_id": 2872513,
      "emis_lastverifiedon": "",
      "emis_nextverification": "",
      "emis_verification": "none",
      "emis_tooltip": "",
      "emis_lastverifiedby": "",
      "env_alarm_icon": "no",
      "techs": [
        {
          "userid": "akersja",
          "name": "Jason Akers"
        },
        {
          "userid": "anclaan",
          "name": "Anthony Anclard"
        },
        {
          "userid": "bostda2",
          "name": "Darwin Bostick"
        },
        {
          "userid": "burriwe",
          "name": "Wesley Burris"
        },
        {
          "userid": "cutteda",
          "name": "Dana Cutter"
        },
        {
          "userid": "davjo16",
          "name": "Joey Davis"
        },
        {
          "userid": "kaspda1",
          "name": "David Kasper"
        },
        {
          "userid": "lewida6",
          "name": "David Lewis"
        },
        {
          "userid": "logwoli",
          "name": "Lillian Logwood"
        },
        {
          "userid": "patrra1",
          "name": "Randy Patrick"
        },
        {
          "userid": "trenan1",
          "name": "Angela Trent"
        },
        {
          "userid": "v790975",
          "name": "Peter Mayer"
        }
      ],
      "mgrs": [
        {
          "userid": "clar1wa",
          "name": "Walter Clark"
        }
      ]
    },
    {
      "switch_unid": "91EC711719D8864FB0774CEBD5136C34",
      "switch_name": "Duff Drive 2",
      "latitude": "38.65194444",
      "longitude": "-83.74555556",
      "switch_clli": "CNCQOH22CM2",
      "switch_callout_zone": "SWITCH_Duff",
      "area": "Great Lakes",
      "region": "OPW",
      "market": "Ohio",
      "remedy_switch": "DUFF 2_MTX",
      "remedy_switch2": "DUFF DR 2 1",
      "remedy_switch3": "DUFF DR 2 2",
      "remedy_switch4": "LEWIS CENTER_BSM_11",
      "switch_xing_id": 90762,
      "switch_emis_id": "3337364",
      "switch_network_id": null,
      "emis_lastverifiedon": "2018-01-19",
      "emis_nextverification": "",
      "emis_verification": "none",
      "emis_tooltip": "",
      "emis_lastverifiedby": "nelsoer",
      "env_alarm_icon": "no",
      "techs": [
        {
          "userid": "akersja",
          "name": "Jason Akers"
        },
        {
          "userid": "anclaan",
          "name": "Anthony Anclard"
        },
        {
          "userid": "bostda2",
          "name": "Darwin Bostick"
        },
        {
          "userid": "burriwe",
          "name": "Wesley Burris"
        },
        {
          "userid": "cutteda",
          "name": "Dana Cutter"
        },
        {
          "userid": "davjo16",
          "name": "Joey Davis"
        },
        {
          "userid": "kaspda1",
          "name": "David Kasper"
        },
        {
          "userid": "lewida6",
          "name": "David Lewis"
        },
        {
          "userid": "logwoli",
          "name": "Lillian Logwood"
        },
        {
          "userid": "patrra1",
          "name": "Randy Patrick"
        },
        {
          "userid": "trenan1",
          "name": "Angela Trent"
        },
        {
          "userid": "v790975",
          "name": "Peter Mayer"
        }
      ],
      "mgrs": [
        {
          "userid": "clar1wa",
          "name": "Walter Clark"
        }
      ]
    }
  ]
}

*/
?>