<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Province;
use App\Models\Country;

class ProvinceSeeder extends Seeder
{
    public function run()
    {
        $country = Country::where('iso', 'ES')->first();

        $provinces = [
            [
            'uid' => 'f2200cb1-35a2-4822-bee1-44be12667210',
            'country_id' => $country->id,
            'title' => 'Araba/Álava',
            'iso' => '01'
        ],[
            'uid' => '07ce93fd-1d02-4b2f-967a-2a59b713abea',
            'country_id' => $country->id,
            'title' => 'Albacete',
            'iso' => '02'
        ],[
            'uid' => '8dee6326-c3f8-4556-a6a3-a53a6e4a9206',
            'country_id' => $country->id,
            'title' => 'Alicante/Alacant',
            'iso' => '03'
        ],[
            'uid' => 'a9f7def4-1c8c-4124-9062-42b4dd535d7b',
            'country_id' => $country->id,
            'title' => 'Almería',
            'iso' => '04'
        ],[
            'uid' => '34a7c76b-68a9-4281-8482-2916885aeee4',
            'country_id' => $country->id,
            'title' => 'Ávila',
            'iso' => '05'
        ],[
            'uid' => 'a9dc9345-217d-4ebf-8b50-3695a03a9021',
            'country_id' => $country->id,
            'title' => 'Badajoz',
            'iso' => '06'
        ],[
            'uid' => 'b8d3f410-2792-40f3-91c4-8c61b5edf694',
            'country_id' => $country->id,
            'title' => 'Illes Balears',
            'iso' => '07'
        ],[
            'uid' => '684ca5cc-62eb-408e-8bab-660f6a04e700',
            'country_id' => $country->id,
            'title' => 'Barcelona',
            'iso' => '08'
        ],[
            'uid' => '06bab11a-f0cf-463b-b8db-43d280a31d15',
            'country_id' => $country->id,
            'title' => 'Tarragona',
            'iso' => '43'
        ],[
            'uid' => 'd97578be-270e-4898-b6e1-7e67c425d201',
            'country_id' => $country->id,
            'title' => 'Burgos',
            'iso' => '09'
        ],[
            'uid' => '8dad2769-2f10-4601-9713-8c4b919e1b80',
            'country_id' => $country->id,
            'title' => 'Palencia',
            'iso' => '34'
        ],[
            'uid' => 'cdffd43e-bdc3-45ef-a811-caece69a4be8',
            'country_id' => $country->id,
            'title' => 'Cantabria',
            'iso' => '39'
        ],[
            'uid' => 'f8dfc2c6-4e66-4db2-9ad1-ed9f9ced4193',
            'country_id' => $country->id,
            'title' => 'La Rioja',
            'iso' => '26'
        ],[
            'uid' => '1a34db2d-36d0-46cb-b3d2-50d72dc69868',
            'country_id' => $country->id,
            'title' => 'Cáceres',
            'iso' => '10'
        ],[
            'uid' => 'c20a0182-ecaa-4581-b6d8-22c10e80b315',
            'country_id' => $country->id,
            'title' => 'Cádiz',
            'iso' => '11'
        ],[
            'uid' => 'c9136a78-d7c9-4516-bb74-8b9d2384a51e',
            'country_id' => $country->id,
            'title' => 'Castellón/Castelló',
            'iso' => '12'
        ],[
            'uid' => '395d3012-590e-4364-8e19-757ea0d26348',
            'country_id' => $country->id,
            'title' => 'Ciudad Real',
            'iso' => '13'
        ],[
            'uid' => 'a2a64994-9d49-4fd4-a803-3a8bdd2b4c28',
            'country_id' => $country->id,
            'title' => 'Córdoba',
            'iso' => '14'
        ],[
            'uid' => 'c9e66cf3-7f5e-44a0-9dea-a7b7dad61922',
            'country_id' => $country->id,
            'title' => 'A Coruña',
            'iso' => '15'
        ],[
            'uid' => 'b6a26137-0051-44db-be52-9c3e9faeb3d3',
            'country_id' => $country->id,
            'title' => 'Cuenca',
            'iso' => '16'
        ],[
            'uid' => 'ad3efa72-44b0-4fbc-b267-d4a39936d3a0',
            'country_id' => $country->id,
            'title' => 'Girona',
            'iso' => '17'
        ],[
            'uid' => 'ea6ff2f1-adbb-42fe-92f1-a67e5299b59f',
            'country_id' => $country->id,
            'title' => 'Granada',
            'iso' => '18'
        ],[
            'uid' => 'e6c2b16d-0c37-41b3-8e56-c02a82fd6bdd',
            'country_id' => $country->id,
            'title' => 'Guadalajara',
            'iso' => '19'
        ],[
            'uid' => 'f7911ff8-908d-49c8-9440-cdeb16445648',
            'country_id' => $country->id,
            'title' => 'Madrid',
            'iso' => '28'
        ],[
            'uid' => 'b683161f-4fbb-471b-a0c9-17b8829c990c',
            'country_id' => $country->id,
            'title' => 'Gipuzkoa',
            'iso' => '20'
        ],[
            'uid' => '75fb61bc-4bef-405e-a218-425d61e1197d',
            'country_id' => $country->id,
            'title' => 'Huelva',
            'iso' => '21'
        ],[
            'uid' => '604646fc-eb3e-4490-9adc-8bba1a7747b7',
            'country_id' => $country->id,
            'title' => 'Huesca',
            'iso' => '22'
        ],[
            'uid' => '6daeeaae-3ed2-4302-8327-030c0ae1d16d',
            'country_id' => $country->id,
            'title' => 'Jaén',
            'iso' => '23'
        ],[
            'uid' => 'ec460972-ea0f-4e64-9e0b-8455bcfad2f6',
            'country_id' => $country->id,
            'title' => 'León',
            'iso' => '24'
        ],[
            'uid' => '9a2aa18c-46d3-4660-9f81-3c21b129cde2',
            'country_id' => $country->id,
            'title' => 'Lleida',
            'iso' => '25'
        ],[
            'uid' => 'a1b7d16c-7de1-45b3-a067-96dba1cdf5c5',
            'country_id' => $country->id,
            'title' => 'Lugo',
            'iso' => '27'
        ],[
            'uid' => 'fb993cac-576c-436b-b27b-3b72fb66be31',
            'country_id' => $country->id,
            'title' => 'Málaga',
            'iso' => '29'
        ],[
            'uid' => 'b7a75bb0-92df-4439-8e02-8eac00752f17',
            'country_id' => $country->id,
            'title' => 'Murcia',
            'iso' => '30'
        ],[
            'uid' => '808de295-c2ca-4d69-9c98-9564abf33de6',
            'country_id' => $country->id,
            'title' => 'Navarra',
            'iso' => '31'
        ],[
            'uid' => '60c73e78-1f71-4ded-8910-1a8bfe49582b',
            'country_id' => $country->id,
            'title' => 'Zaragoza',
            'iso' => '50'
        ],[
            'uid' => '5fe6c56b-dbc2-4ae3-829c-44a2b980885d',
            'country_id' => $country->id,
            'title' => 'Ourense',
            'iso' => '32'
        ],[
            'uid' => '333e4f81-0e8b-4fb7-8ad8-0c5a6dcc9d95',
            'country_id' => $country->id,
            'title' => 'Asturias',
            'iso' => '33'
        ],[
            'uid' => 'a0dadbd7-9748-47df-b99c-db647be9e110',
            'country_id' => $country->id,
            'title' => 'Las Palmas',
            'iso' => '35'
        ],[
            'uid' => 'b0a01823-ea6b-4d94-8a8f-60ffde840cc0',
            'country_id' => $country->id,
            'title' => 'Pontevedra',
            'iso' => '36'
        ],[
            'uid' => '765f697c-9799-48b7-a9d6-8af3f6a6b32f',
            'country_id' => $country->id,
            'title' => 'Salamanca',
            'iso' => '37'
        ],[
            'uid' => 'd8729cf0-d546-4456-bd05-6c2f76d3168d',
            'country_id' => $country->id,
            'title' => 'Santa Cruz de Tenerife',
            'iso' => '38'
        ],[
            'uid' => '9017b9ad-8eac-4922-b7bc-560dbbaab5d6',
            'country_id' => $country->id,
            'title' => 'Segovia',
            'iso' => '40'
        ],[
            'uid' => '3985febf-771c-422a-b558-1473824870e7',
            'country_id' => $country->id,
            'title' => 'Sevilla',
            'iso' => '41'
        ],[
            'uid' => 'c3f036a2-a182-4a21-8e79-af9b5940d383',
            'country_id' => $country->id,
            'title' => 'Soria',
            'iso' => '42'
        ],[
            'uid' => 'befcade9-7e9c-4710-be15-19532a5b0a8b',
            'country_id' => $country->id,
            'title' => 'Teruel',
            'iso' => '44'
        ],[
            'uid' => '046584cc-58e4-4831-97e3-da39818693ff',
            'country_id' => $country->id,
            'title' => 'Toledo',
            'iso' => '45'
        ],[
            'uid' => 'fb0e9eca-d3c5-428a-a169-724aa71e42dd',
            'country_id' => $country->id,
            'title' => 'Valencia/València',
            'iso' => '46'
        ],[
            'uid' => 'b87506e4-07e4-4af7-a1d0-e655b467c5b2',
            'country_id' => $country->id,
            'title' => 'Valladolid',
            'iso' => '47'
        ],[
            'uid' => '2cb6c95f-43e5-47e0-a037-6b41eae03e52',
            'country_id' => $country->id,
            'title' => 'Bizkaia',
            'iso' => '48'
        ],[
            'uid' => 'df085139-9fc8-4216-b8da-60e8db4b0df6',
            'country_id' => $country->id,
            'title' => 'Zamora',
            'iso' => '49'
        ],[
            'uid' => '11162ab3-2fc0-4021-9385-cbcb49c9d3a8',
            'country_id' => $country->id,
            'title' => 'Ceuta',
            'iso' => '51'
        ],[
            'uid' => 'a3d82005-679e-4f53-8a31-27d87624cba4',
            'country_id' => $country->id,
            'title' => 'Melilla',
            'iso' => '52'
        ]
        ];

        foreach ($provinces as $province) {
            Province::create($province);
        }
    }
}
