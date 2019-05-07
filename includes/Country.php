<?php
require_once 'initialize.php';

class Country extends Common
{

	public $name;

	protected static $table_name = "country";

	protected static $db_fields = array(
		'id',
		'country',
		'co_code'
	);

	public $id;

	public $country;

	public $co_code;

	public function load_name()
	{
		// Country Name Code
		$this->name = array(
			"Afghanistan" => "AF",
			"Albania" => "AL",
			"Algeria" => "DZ",
			"Angola" => "AO",
			"Argentina" => "AR",
			"Armenia" => "AM",
			"Australia" => "AU",
			"Austria" => "AT",
			"Azerbaijan" => "AZ",
			"Bahrain" => "BH",
			"Bangladesh" => "BD",
			"Barbados" => "BB",
			"Belarus" => "BY",
			"Belgium" => "BE",
			"Belize" => "BZ",
			"Bolivia" => "BO",
			"Botswana" => "BW",
			"Brazil" => "BR",
			"Bulgaria" => "BG",
			"Cambodia" => "KH",
			"Cameroon" => "CM",
			"Canada" => "CA",
			"Cayman Islands" => "KY",
			"Chad" => "TD",
			"Chile" => "CL",
			"China" => "CN",
			"Colombia" => "CO",
			"Comoros" => "KM",
			"Costa Rica" => "CR",
			"Croatia" => "HR",
			"Cuba" => "CU",
			"Cyprus" => "CY",
			"Czech Republic" => "CZ",
			"Denmark" => "DK",
			"Djibouti" => "DJ",
			"Ecuador" => "EC",
			"Egypt" => "EG",
			"El Salvador" => "SV",
			"Equatorial Guinea" => "GQ",
			"Estonia" => "EE",
			"Ethiopia" => "ET",
			"Fiji" => "FJ",
			"Finland" => "FI",
			"France" => "FR",
			"Gabon " => "GA",
			"Gambia" => "GM",
			"Georgia" => "GE",
			"Germany" => "DE",
			"Ghana" => "GH",
			"Greece" => "GR",
			"Greenland" => "GL",
			"Guam" => "GU",
			"Guatemala" => "GT",
			"Guinea" => "GN",
			"Guyana" => "GY",
			"Haiti" => "HT",
			"Honduras" => "HN",
			"Hong Kong" => "HK",
			"Hungary" => "HU",
			"Iceland" => "IS",
			"India" => "IN",
			"Indonesia" => "ID",
			"Iran" => "IR",
			"Iraq" => "IQ",
			"Ireland" => "IE",
			"Israel" => "IL",
			"Italy" => "IT",
			"Jamaica" => "JM",
			"Japan" => "JP",
			"Jordan" => "JO",
			"Kazakhstan" => "KZ",
			"Kenya" => "KE",
			"Korea" => "KR",
			"Kuwait" => "KW",
			"Kyrgyzstan" => "KG",
			"Laos" => "LA",
			"Latvia" => "LV",
			"Lebanon" => "LB",
			"Lesotho" => "LS",
			"Liberia" => "LR",
			"Lithuania" => "LT",
			"Luxembourg" => "LU",
			"Madagascar" => "MG",
			"Malaysia" => "MY",
			"Mauritius" => "MU",
			"Mexico" => "MX",
			"Monaco" => "MC",
			"Mongolia" => "MN",
			"Morocco" => "MA",
			"Mozambique" => "MZ",
			"Nepal" => "NP",
			"Netherlands" => "NL",
			"New Zealand" => "NZ",
			"Nicaragua" => "NI",
			"Niger" => "NE",
			"Nigeria" => "NG",
			"Norway" => "NO",
			"Oman" => "OM",
			"Pakistan" => "PK",
			"Panama" => "PA",
			"Paraguay" => "PY",
			"Peru" => "PE",
			"Philippines" => "PH",
			"Poland" => "PL",
			"Portugal" => "PT",
			"Puerto Rico" => "PR",
			"Qatar" => "QA",
			"Romania" => "RO",
			"Russia" => "RU",
			"Rwanda" => "RW",
			"Samoa" => "WS",
			"San Marino" => "SM",
			"Saudi Arabia" => "SA",
			"Senegal" => "SN",
			"Serbia" => "RS",
			"Seychelles" => "SC",
			"Sierra Leone" => "SL",
			"Singapore" => "SG",
			"Slovakia" => "SK",
			"Slovenia" => "SI",
			"Somalia" => "SO",
			"South Africa" => "ZA",
			"Spain" => "ES",
			"Sri Lanka" => "LK",
			"Sudan" => "SD",
			"Suriname" => "SR",
			"Swaziland" => "SZ",
			"Sweden" => "SE",
			"Switzerland" => "CH",
			"Syria" => "SY",
			"Taiwan" => "TW",
			"Tanzania" => "TZ",
			"Thailand" => "TH",
			"Togo" => "TG",
			"Tonga" => "TO",
			"Trinidad and Tobago" => "TT",
			"Turkey" => "TR",
			"Turkmenistan" => "TM",
			"Uganda" => "UG",
			"Ukraine" => "UA",
			"United Arab Emirates" => "AE",
			"United Kingdom" => "GB",
			"Uruguay" => "UY",
			"USA" => "US",
			"Uzbekistan" => "UZ",
			"Vanuatu" => "VU",
			"Venezuela" => "VE",
			"Vietnam" => "VN",
			"British Virgin Islands" => "VG",
			"Yemen" => "YE",
			"Zambia" => "ZM",
			"Zimbabwe" => "ZW"
		);
	}

	public static function add_to_table()
	{
		$mycountry = new Country();
		$mycountry->load_name();
		foreach ($mycountry->name as $key => $value) {
			$mycountry->country = $key;
			echo "<br>" . $mycountry->country;
			$mycountry->co_code = $value;
			echo "  " . $mycountry->co_code;
			echo ($mycountry->save()) ? "Saved!" : "Not Saved!";
			$mycountry = new Country();
		}
	}
}

Country::add_to_table();
echo "<br><br>" . 4;