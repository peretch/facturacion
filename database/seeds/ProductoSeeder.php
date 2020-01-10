<?php

use Illuminate\Database\Seeder;

class ProductoSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		DB::table('productos')->insert([
				'codigo' => '295875726-9',
				'nombre' => 'Yogurt - Blueberry, 175 G',
				'codigo_de_barras' => '67296-067',
				'precio' => '241',
				'familiaproducto_id' => 1,
				'tasa_iva_id' => 1,
				'stock' => '10'
		]);
		DB::table('productos')->insert([
				'codigo' => '001242328-9',
				'nombre' => 'Bread - Pullman, Slic',
				'codigo_de_barras' => '63672-000',
				'precio' => '256',
				'familiaproducto_id' => 1,
				'tasa_iva_id' => 1,
				'stock' => '10'
		]);
		DB::table('productos')->insert([
				'codigo' => '425003430-5',
				'nombre' => 'Soup - Campbells, Creamy ',
				'codigo_de_barras' => '49520-104',
				'precio' => '445',
				'familiaproducto_id' => 1,
				'tasa_iva_id' => 1,
				'stock' => '10'
		]);
		DB::table('productos')->insert([
				'codigo' => '447061814-4',
				'nombre' => 'Puree - Mocha',
				'codigo_de_barras' => '51991,-838',
				'precio' => '334',
				'familiaproducto_id' => 1,
				'tasa_iva_id' => 1,
				'stock' => '10'
		]);
		DB::table('productos')->insert([
				'codigo' => '885705810-7',
				'nombre' => 'Tuna - Yellowfin ',
				'codigo_de_barras' => '52959-117',
				'precio' => '240',
				'familiaproducto_id' => 1,
				'tasa_iva_id' => 1,
				'stock' => '10'
		]);
		DB::table('productos')->insert([
				'codigo' => '334745861-3',
				'nombre' => 'Sprouts - Baby Pea Tendri',
				'codigo_de_barras' => '49967-208',
				'precio' => '57',
				'familiaproducto_id' => 1,
				'tasa_iva_id' => 1,
				'stock' => '10'
		]);
		DB::table('productos')->insert([
				'codigo' => '322310897-1',
				'nombre' => 'Lettuce - Romaine, Heart ',
				'codigo_de_barras' => '21695-832',
				'precio' => '115',
				'familiaproducto_id' => 1,
				'tasa_iva_id' => 1,
				'stock' => '10'
		]);
		DB::table('productos')->insert([
				'codigo' => '151874665-9',
				'nombre' => 'Carbonated Water - Blackberry',
				'codigo_de_barras' => '59062-124',
				'precio' => '373',
				'familiaproducto_id' => 1,
				'tasa_iva_id' => 1,
				'stock' => '10'
		]);
		DB::table('productos')->insert([
				'codigo' => '252020041-3',
				'nombre' => 'Marsala - Sperone, Fine, D.o.',
				'codigo_de_barras' => '54569-345',
				'precio' => '192',
				'familiaproducto_id' => 1,
				'tasa_iva_id' => 1,
				'stock' => '10'
		]);
		DB::table('productos')->insert([
				'codigo' => '889576493-5',
				'nombre' => 'Dip - Tapenad',
				'codigo_de_barras' => '51060-051',
				'precio' => '33',
				'familiaproducto_id' => 1,
				'tasa_iva_id' => 1,
				'stock' => '10'
		]);
		DB::table('productos')->insert([
				'codigo' => '361107224-9',
				'nombre' => 'Pepper - Scotch Bonne',
				'codigo_de_barras' => '49884-303',
				'precio' => '63',
				'familiaproducto_id' => 1,
				'tasa_iva_id' => 1,
				'stock' => '10'
		]);
		DB::table('productos')->insert([
				'codigo' => '866783639-7',
				'nombre' => 'Cardamon Seed / P',
				'codigo_de_barras' => '63629-476',
				'precio' => '152',
				'familiaproducto_id' => 1,
				'tasa_iva_id' => 1,
				'stock' => '10'
		]);
		DB::table('productos')->insert([
				'codigo' => '026977516-1',
				'nombre' => 'Nantucket - Orange Mango Cktl',
				'codigo_de_barras' => '54868-529',
				'precio' => '375',
				'familiaproducto_id' => 1,
				'tasa_iva_id' => 1,
				'stock' => '10'
		]);
		DB::table('productos')->insert([
				'codigo' => '770895960-8',
				'nombre' => 'Juice Peach Necta',
				'codigo_de_barras' => '55312-306',
				'precio' => '147',
				'familiaproducto_id' => 1,
				'tasa_iva_id' => 1,
				'stock' => '10'
		]);
		DB::table('productos')->insert([
				'codigo' => '083028645-4',
				'nombre' => 'Beer - Labatt Blu',
				'codigo_de_barras' => '42549-498',
				'precio' => '270',
				'familiaproducto_id' => 1,
				'tasa_iva_id' => 1,
				'stock' => '10'
		]);
		DB::table('productos')->insert([
				'codigo' => '603969019-4',
				'nombre' => 'Wine - Zinfandel California 2002 ',
				'codigo_de_barras' => '55154-344',
				'precio' => '248',
				'familiaproducto_id' => 1,
				'tasa_iva_id' => 1,
				'stock' => '10'
		]);
		DB::table('productos')->insert([
				'codigo' => '600021824-9',
				'nombre' => 'Coffee - Decafenated ',
				'codigo_de_barras' => '16714-346',
				'precio' => '403',
				'familiaproducto_id' => 1,
				'tasa_iva_id' => 1,
				'stock' => '10'
		]);
		DB::table('productos')->insert([
				'codigo' => '601872562-2',
				'nombre' => 'Chickensplit Half',
				'codigo_de_barras' => '68084-283',
				'precio' => '191',
				'familiaproducto_id' => 1,
				'tasa_iva_id' => 1,
				'stock' => '10'
		]);
		DB::table('productos')->insert([
				'codigo' => '359027232-5',
				'nombre' => 'Beer - Camerons Aubur',
				'codigo_de_barras' => '11822-000',
				'precio' => '285',
				'familiaproducto_id' => 1,
				'tasa_iva_id' => 1,
				'stock' => '10'
		]);
		DB::table('productos')->insert([
				'codigo' => '944180073-2',
				'nombre' => 'Bread - Malt ',
				'codigo_de_barras' => '51079-103',
				'precio' => '434',
				'familiaproducto_id' => 1,
				'tasa_iva_id' => 1,
				'stock' => '10'
		]);
		DB::table('productos')->insert([
				'codigo' => '465189790-8',
				'nombre' => 'Cheese Cloth No 1',
				'codigo_de_barras' => '55390-613',
				'precio' => '297',
				'familiaproducto_id' => 1,
				'tasa_iva_id' => 1,
				'stock' => '10'
		]);
		DB::table('productos')->insert([
				'codigo' => '633946774-1',
				'nombre' => 'Flour - R',
				'codigo_de_barras' => '0781-1438',
				'precio' => '100',
				'familiaproducto_id' => 1,
				'tasa_iva_id' => 1,
				'stock' => '10'
		]);
		DB::table('productos')->insert([
				'codigo' => '527935329-9',
				'nombre' => 'Nantucket Apple Juice',
				'codigo_de_barras' => '61957-011',
				'precio' => '127',
				'familiaproducto_id' => 1,
				'tasa_iva_id' => 1,
				'stock' => '10'
		]);
		DB::table('productos')->insert([
				'codigo' => '235672681-0',
				'nombre' => 'Soap - Mr.clean Floor Soa',
				'codigo_de_barras' => '36987-206',
				'precio' => '246',
				'familiaproducto_id' => 1,
				'tasa_iva_id' => 1,
				'stock' => '10'
		]);
		DB::table('productos')->insert([
				'codigo' => '791037243-4',
				'nombre' => 'Chocolate - Milk Coating ',
				'codigo_de_barras' => '0944-2960',
				'precio' => '110',
				'familiaproducto_id' => 1,
				'tasa_iva_id' => 1,
				'stock' => '10'
		]);
		DB::table('productos')->insert([
				'codigo' => '723311597-4',
				'nombre' => 'Yeast - Fresh, Fleischman',
				'codigo_de_barras' => '59579-008',
				'precio' => '460',
				'familiaproducto_id' => 1,
				'tasa_iva_id' => 1,
				'stock' => '10'
		]);
		DB::table('productos')->insert([
				'codigo' => '702670560-1',
				'nombre' => 'Bread - Pumpernickel ',
				'codigo_de_barras' => '76420-772',
				'precio' => '49',
				'familiaproducto_id' => 1,
				'tasa_iva_id' => 1,
				'stock' => '10'
		]);
		DB::table('productos')->insert([
				'codigo' => '525262024-5',
				'nombre' => 'Greens Mustar',
				'codigo_de_barras' => '36987-265',
				'precio' => '238',
				'familiaproducto_id' => 1,
				'tasa_iva_id' => 1,
				'stock' => '10'
		]);
		DB::table('productos')->insert([
				'codigo' => '708607376-8',
				'nombre' => 'Sardines ',
				'codigo_de_barras' => '64893-365',
				'precio' => '46',
				'familiaproducto_id' => 1,
				'tasa_iva_id' => 1,
				'stock' => '10'
		]);
		DB::table('productos')->insert([
				'codigo' => '598761656-5',
				'nombre' => 'Mousse - Banana Chocolate',
				'codigo_de_barras' => '63824-256',
				'precio' => '207',
				'familiaproducto_id' => 1,
				'tasa_iva_id' => 1,
				'stock' => '10'
		]);
		DB::table('productos')->insert([
				'codigo' => '871209006-9',
				'nombre' => 'Cheese - Woolwich Goat, L',
				'codigo_de_barras' => '10345-024',
				'precio' => '481',
				'familiaproducto_id' => 1,
				'tasa_iva_id' => 1,
				'stock' => '10'
		]);
		DB::table('productos')->insert([
				'codigo' => '034835912-8',
				'nombre' => 'Squid Ink',
				'codigo_de_barras' => '59779-381',
				'precio' => '55',
				'familiaproducto_id' => 1,
				'tasa_iva_id' => 1,
				'stock' => '10'
		]);
		DB::table('productos')->insert([
				'codigo' => '298257503-5',
				'nombre' => 'Mop Head - Cotton, 24 Oz ',
				'codigo_de_barras' => '76075-101',
				'precio' => '207',
				'familiaproducto_id' => 1,
				'tasa_iva_id' => 1,
				'stock' => '10'
		]);
		DB::table('productos')->insert([
				'codigo' => '752563147-6',
				'nombre' => 'Pasta - Cannelloni, Sheets, Fresh',
				'codigo_de_barras' => '42315-672',
				'precio' => '417',
				'familiaproducto_id' => 1,
				'tasa_iva_id' => 1,
				'stock' => '10'
		]);
		DB::table('productos')->insert([
				'codigo' => '663523644-9',
				'nombre' => 'Phyllo Dough ',
				'codigo_de_barras' => '65224-618',
				'precio' => '54',
				'familiaproducto_id' => 1,
				'tasa_iva_id' => 1,
				'stock' => '10'
		]);
		DB::table('productos')->insert([
				'codigo' => '418553882-0',
				'nombre' => 'Juice - Tomato, 49 Oz',
				'codigo_de_barras' => '55154-286',
				'precio' => '494',
				'familiaproducto_id' => 1,
				'tasa_iva_id' => 1,
				'stock' => '10'
		]);
		DB::table('productos')->insert([
				'codigo' => '795677284-2',
				'nombre' => 'Sugar - Sweet N Low, Individu',
				'codigo_de_barras' => '57243-291',
				'precio' => '225',
				'familiaproducto_id' => 1,
				'tasa_iva_id' => 1,
				'stock' => '10'
		]);
		DB::table('productos')->insert([
				'codigo' => '313217335-5',
				'nombre' => 'Coffee Beans - Chocolate ',
				'codigo_de_barras' => '55504-050',
				'precio' => '193',
				'familiaproducto_id' => 1,
				'tasa_iva_id' => 1,
				'stock' => '10'
		]);
		DB::table('productos')->insert([
				'codigo' => '747404875-2',
				'nombre' => 'Sansho Powder',
				'codigo_de_barras' => '49738-079',
				'precio' => '471',
				'familiaproducto_id' => 1,
				'tasa_iva_id' => 1,
				'stock' => '10'
		]);
		DB::table('productos')->insert([
				'codigo' => '359635459-5',
				'nombre' => 'Flour - Pastr',
				'codigo_de_barras' => '30142-916',
				'precio' => '451',
				'familiaproducto_id' => 1,
				'tasa_iva_id' => 1,
				'stock' => '10'
		]);
		DB::table('productos')->insert([
				'codigo' => '235952866-1',
				'nombre' => 'Apple - Macintosh',
				'codigo_de_barras' => '36800-734',
				'precio' => '108',
				'familiaproducto_id' => 1,
				'tasa_iva_id' => 1,
				'stock' => '10'
		]);
		DB::table('productos')->insert([
				'codigo' => '494292515-0',
				'nombre' => 'Wine - Sicilia Igt Nero Avola',
				'codigo_de_barras' => '0781-6077',
				'precio' => '384',
				'familiaproducto_id' => 1,
				'tasa_iva_id' => 1,
				'stock' => '10'
		]);
		DB::table('productos')->insert([
				'codigo' => '878626387-0',
				'nombre' => 'Truffle Cups - Re',
				'codigo_de_barras' => '29500-221',
				'precio' => '257',
				'familiaproducto_id' => 1,
				'tasa_iva_id' => 1,
				'stock' => '10'
		]);
		DB::table('productos')->insert([
				'codigo' => '082005049-0',
				'nombre' => 'Eggplant - Asian ',
				'codigo_de_barras' => '0113-0400',
				'precio' => '462',
				'familiaproducto_id' => 1,
				'tasa_iva_id' => 1,
				'stock' => '10'
		]);
		DB::table('productos')->insert([
				'codigo' => '574724118-4',
				'nombre' => 'Cheese - Colb',
				'codigo_de_barras' => '0065-0647',
				'precio' => '453',
				'familiaproducto_id' => 1,
				'tasa_iva_id' => 1,
				'stock' => '10'
		]);
		DB::table('productos')->insert([
				'codigo' => '576958123-9',
				'nombre' => 'Juice - Pineapple, 48 Oz ',
				'codigo_de_barras' => '68462-165',
				'precio' => '232',
				'familiaproducto_id' => 1,
				'tasa_iva_id' => 1,
				'stock' => '10'
		]);
		DB::table('productos')->insert([
				'codigo' => '588319434-6',
				'nombre' => 'Caviar - Salm',
				'codigo_de_barras' => '59575-501',
				'precio' => '296',
				'familiaproducto_id' => 1,
				'tasa_iva_id' => 1,
				'stock' => '10'
		]);
		DB::table('productos')->insert([
				'codigo' => '141302991-4',
				'nombre' => 'Ecolab - Medallio',
				'codigo_de_barras' => '65862-657',
				'precio' => '112',
				'familiaproducto_id' => 1,
				'tasa_iva_id' => 1,
				'stock' => '10'
		]);
		DB::table('productos')->insert([
				'codigo' => '971118961-5',
				'nombre' => 'Tomato - Tricolor Cherry ',
				'codigo_de_barras' => '42367-111',
				'precio' => '236',
				'familiaproducto_id' => 1,
				'tasa_iva_id' => 1,
				'stock' => '10'
		]);
		DB::table('productos')->insert([
				'codigo' => '825813060-9',
				'nombre' => 'Soup - Campbells, Classic Chi',
				'codigo_de_barras' => '47593-387',
				'precio' => '290',
				'familiaproducto_id' => 1,
				'tasa_iva_id' => 1,
				'stock' => '10'
		]);
		DB::table('productos')->insert([
				'codigo' => '906233803-8',
				'nombre' => 'Juice - Tomato, 48 Oz',
				'codigo_de_barras' => '57520-060',
				'precio' => '391',
				'familiaproducto_id' => 1,
				'tasa_iva_id' => 1,
				'stock' => '10'
		]);
		DB::table('productos')->insert([
				'codigo' => '032308375-7',
				'nombre' => 'Liquid Aminios Acid - Braggs ',
				'codigo_de_barras' => '67253-383',
				'precio' => '190',
				'familiaproducto_id' => 1,
				'tasa_iva_id' => 1,
				'stock' => '10'
		]);
		DB::table('productos')->insert([
				'codigo' => '085019165-3',
				'nombre' => 'Eggplant - Ba',
				'codigo_de_barras' => '52125-457',
				'precio' => '303',
				'familiaproducto_id' => 1,
				'tasa_iva_id' => 1,
				'stock' => '10'
		]);
		DB::table('productos')->insert([
				'codigo' => '682083180-3',
				'nombre' => 'Duck - Breast',
				'codigo_de_barras' => '50114-700',
				'precio' => '338',
				'familiaproducto_id' => 1,
				'tasa_iva_id' => 1,
				'stock' => '10'
		]);
		DB::table('productos')->insert([
				'codigo' => '394436851-7',
				'nombre' => 'Ecolab - Ster Bac',
				'codigo_de_barras' => '63824-321',
				'precio' => '446',
				'familiaproducto_id' => 1,
				'tasa_iva_id' => 1,
				'stock' => '10'
		]);
		DB::table('productos')->insert([
				'codigo' => '988996322-1',
				'nombre' => 'Myers Planters Punch ',
				'codigo_de_barras' => '64942-111',
				'precio' => '31',
				'familiaproducto_id' => 1,
				'tasa_iva_id' => 1,
				'stock' => '10'
		]);
		DB::table('productos')->insert([
				'codigo' => '048893295-5',
				'nombre' => 'Chips Potato All Dressed - 43',
				'codigo_de_barras' => '57844-117',
				'precio' => '67',
				'familiaproducto_id' => 1,
				'tasa_iva_id' => 1,
				'stock' => '10'
		]);
		DB::table('productos')->insert([
				'codigo' => '338660953-8',
				'nombre' => 'Yoplait - Strawbrasp Peac',
				'codigo_de_barras' => '67457-146',
				'precio' => '32',
				'familiaproducto_id' => 1,
				'tasa_iva_id' => 1,
				'stock' => '10'
		]);
		DB::table('productos')->insert([
				'codigo' => '211777423-7',
				'nombre' => 'Hog / Sausage Casing - Po',
				'codigo_de_barras' => '51346-125',
				'precio' => '62',
				'familiaproducto_id' => 1,
				'tasa_iva_id' => 1,
				'stock' => '10'
		]);
		DB::table('productos')->insert([
				'codigo' => '469418922-0',
				'nombre' => 'Juice - Apple, 500 Ml',
				'codigo_de_barras' => '54473-233',
				'precio' => '314',
				'familiaproducto_id' => 1,
				'tasa_iva_id' => 1,
				'stock' => '10'
		]);
		DB::table('productos')->insert([
				'codigo' => '547678212-5',
				'nombre' => 'Soup - Cream Of Broccoli, Dry',
				'codigo_de_barras' => '0363-0917',
				'precio' => '257',
				'familiaproducto_id' => 1,
				'tasa_iva_id' => 1,
				'stock' => '10'
		]);
		DB::table('productos')->insert([
				'codigo' => '769288161-8',
				'nombre' => 'Cumin - Whole',
				'codigo_de_barras' => '16590-891',
				'precio' => '438',
				'familiaproducto_id' => 1,
				'tasa_iva_id' => 1,
				'stock' => '10'
		]);
		DB::table('productos')->insert([
				'codigo' => '153324370-0',
				'nombre' => 'Salt - Rock, Cour',
				'codigo_de_barras' => '49288-022',
				'precio' => '146',
				'familiaproducto_id' => 1,
				'tasa_iva_id' => 1,
				'stock' => '10'
		]);
		DB::table('productos')->insert([
				'codigo' => '158262901-3',
				'nombre' => 'Dried Fig',
				'codigo_de_barras' => '63187-137',
				'precio' => '410',
				'familiaproducto_id' => 1,
				'tasa_iva_id' => 1,
				'stock' => '10'
		]);
		DB::table('productos')->insert([
				'codigo' => '287920021-0',
				'nombre' => 'Nantucket Orange Juic',
				'codigo_de_barras' => '65923-006',
				'precio' => '92',
				'familiaproducto_id' => 1,
				'tasa_iva_id' => 1,
				'stock' => '10'
		]);
		DB::table('productos')->insert([
				'codigo' => '727237039-4',
				'nombre' => 'Ostrich - Fan Fillet ',
				'codigo_de_barras' => '0143-9878',
				'precio' => '322',
				'familiaproducto_id' => 1,
				'tasa_iva_id' => 1,
				'stock' => '10'
		]);
		DB::table('productos')->insert([
				'codigo' => '980757110-3',
				'nombre' => 'Tortillas - Flour, 8 ',
				'codigo_de_barras' => '54868-460',
				'precio' => '385',
				'familiaproducto_id' => 1,
				'tasa_iva_id' => 1,
				'stock' => '10'
		]);
		
		DB::table('productos')->insert([
				'codigo' => '436068453-3',
				'nombre' => 'Seaweed Green Sheets ',
				'codigo_de_barras' => '57520-023',
				'precio' => '416',
				'familiaproducto_id' => 1,
				'tasa_iva_id' => 1,
				'stock' => '10'
		]);
		DB::table('productos')->insert([
				'codigo' => '704839303-3',
				'nombre' => 'Ice Cream - Super Sandwic',
				'codigo_de_barras' => '55154-966',
				'precio' => '477',
				'familiaproducto_id' => 1,
				'tasa_iva_id' => 1,
				'stock' => '10'
		]);
		DB::table('productos')->insert([
				'codigo' => '782334094-1',
				'nombre' => 'Wine - White, Riesling, Semi - Dr',
				'codigo_de_barras' => '64578-010',
				'precio' => '160',
				'familiaproducto_id' => 1,
				'tasa_iva_id' => 1,
				'stock' => '10'
		]);
		DB::table('productos')->insert([
				'codigo' => '553647266-6',
				'nombre' => 'Rosemary - Primerba, Past',
				'codigo_de_barras' => '54868-170',
				'precio' => '256',
				'familiaproducto_id' => 1,
				'tasa_iva_id' => 1,
				'stock' => '10'
		]);
		DB::table('productos')->insert([
				'codigo' => '599644329-5',
				'nombre' => 'Table Cloth 62x120 White ',
				'codigo_de_barras' => '10565-075',
				'precio' => '177',
				'familiaproducto_id' => 1,
				'tasa_iva_id' => 1,
				'stock' => '10'
		]);
		DB::table('productos')->insert([
				'codigo' => '290244387-0',
				'nombre' => 'Lamb - Leg, Bone ',
				'codigo_de_barras' => '42023-109',
				'precio' => '310',
				'familiaproducto_id' => 1,
				'tasa_iva_id' => 1,
				'stock' => '10'
		]);
		DB::table('productos')->insert([
				'codigo' => '333932922-2',
				'nombre' => 'Wine - Marlbourough Sauv Blan',
				'codigo_de_barras' => '55111-310',
				'precio' => '489',
				'familiaproducto_id' => 1,
				'tasa_iva_id' => 1,
				'stock' => '10'
		]);
		DB::table('productos')->insert([
				'codigo' => '671392820-X',
				'nombre' => 'Soup - Campbells, Lentil ',
				'codigo_de_barras' => '0280-1175',
				'precio' => '131',
				'familiaproducto_id' => 1,
				'tasa_iva_id' => 1,
				'stock' => '10'
		]);
		DB::table('productos')->insert([
				'codigo' => '705808179-4',
				'nombre' => 'Beer - Tetley',
				'codigo_de_barras' => '10812-970',
				'precio' => '297',
				'familiaproducto_id' => 1,
				'tasa_iva_id' => 1,
				'stock' => '10'
		]);
		DB::table('productos')->insert([
				'codigo' => '550885721-4',
				'nombre' => 'Chicken - Livers ',
				'codigo_de_barras' => '59262-257',
				'precio' => '392',
				'familiaproducto_id' => 1,
				'tasa_iva_id' => 1,
				'stock' => '10'
		]);
		DB::table('productos')->insert([
				'codigo' => '842047229-8',
				'nombre' => 'Persimmon',
				'codigo_de_barras' => '11509-001',
				'precio' => '82',
				'familiaproducto_id' => 1,
				'tasa_iva_id' => 1,
				'stock' => '10'
		]);
		DB::table('productos')->insert([
				'codigo' => '937522073-7',
				'nombre' => '7up Diet, 355 Ml ',
				'codigo_de_barras' => '49348-918',
				'precio' => '77',
				'familiaproducto_id' => 1,
				'tasa_iva_id' => 1,
				'stock' => '10'
		]);
		DB::table('productos')->insert([
				'codigo' => '584548325-5',
				'nombre' => 'Cleaner - Pine So',
				'codigo_de_barras' => '68084-451',
				'precio' => '411',
				'familiaproducto_id' => 1,
				'tasa_iva_id' => 1,
				'stock' => '10'
		]);
		DB::table('productos')->insert([
				'codigo' => '005767599-6',
				'nombre' => 'Clam - Cherryston',
				'codigo_de_barras' => '68788-459',
				'precio' => '383',
				'familiaproducto_id' => 1,
				'tasa_iva_id' => 1,
				'stock' => '10'
		]);
		DB::table('productos')->insert([
				'codigo' => '455412823-7',
				'nombre' => 'Fondant - Ici',
				'codigo_de_barras' => '10812-418',
				'precio' => '102',
				'familiaproducto_id' => 1,
				'tasa_iva_id' => 1,
				'stock' => '10'
		]);
		DB::table('productos')->insert([
				'codigo' => '971928234-7',
				'nombre' => 'Dc Hikiage Hira Huba ',
				'codigo_de_barras' => '0065-0411',
				'precio' => '417',
				'familiaproducto_id' => 1,
				'tasa_iva_id' => 1,
				'stock' => '10'
		]);
		DB::table('productos')->insert([
				'codigo' => '679999929-1',
				'nombre' => 'Plasticspoonblack',
				'codigo_de_barras' => '55154-420',
				'precio' => '379',
				'familiaproducto_id' => 1,
				'tasa_iva_id' => 1,
				'stock' => '10'
		]);
		DB::table('productos')->insert([
				'codigo' => '358174550-X',
				'nombre' => 'Veal - Round, Eye Of ',
				'codigo_de_barras' => '99207-290',
				'precio' => '71',
				'familiaproducto_id' => 1,
				'tasa_iva_id' => 1,
				'stock' => '10'
		]);
		DB::table('productos')->insert([
				'codigo' => '954057989-9',
				'nombre' => 'Soup - Beef, Base Mix',
				'codigo_de_barras' => '0143-9682',
				'precio' => '95',
				'familiaproducto_id' => 1,
				'tasa_iva_id' => 1,
				'stock' => '10'
		]);
		DB::table('productos')->insert([
				'codigo' => '761355393-0',
				'nombre' => 'Soup - Canadian Pea, Dry Mix ',
				'codigo_de_barras' => '0574-2121',
				'precio' => '444',
				'familiaproducto_id' => 1,
				'tasa_iva_id' => 1,
				'stock' => '10'
		]);
		DB::table('productos')->insert([
				'codigo' => '097267675-9',
				'nombre' => 'Salmon Steak - Cohoe 8 Oz',
				'codigo_de_barras' => '43063-455',
				'precio' => '169',
				'familiaproducto_id' => 1,
				'tasa_iva_id' => 1,
				'stock' => '10'
		]);
		DB::table('productos')->insert([
				'codigo' => '497722617-8',
				'nombre' => 'Wine - Chateau Timberlay ',
				'codigo_de_barras' => '0004-0028',
				'precio' => '489',
				'familiaproducto_id' => 1,
				'tasa_iva_id' => 1,
				'stock' => '10'
		]);
		DB::table('productos')->insert([
				'codigo' => '529230515-4',
				'nombre' => 'Foil Cont Rou',
				'codigo_de_barras' => '41520-866',
				'precio' => '275',
				'familiaproducto_id' => 1,
				'tasa_iva_id' => 1,
				'stock' => '10'
		]);
		DB::table('productos')->insert([
				'codigo' => '596130349-7',
				'nombre' => 'Magnotta Bel Paese Re',
				'codigo_de_barras' => '44911-002',
				'precio' => '182',
				'familiaproducto_id' => 1,
				'tasa_iva_id' => 1,
				'stock' => '10'
		]);
		DB::table('productos')->insert([
				'codigo' => '002358286-3',
				'nombre' => 'Turkey - Oven Roast Breas',
				'codigo_de_barras' => '49663-002',
				'precio' => '243',
				'familiaproducto_id' => 1,
				'tasa_iva_id' => 1,
				'stock' => '10'
		]);
		DB::table('productos')->insert([
				'codigo' => '432248418-2',
				'nombre' => 'Bread Crumbs - Japanese Style',
				'codigo_de_barras' => '49349-892',
				'precio' => '305',
				'familiaproducto_id' => 1,
				'tasa_iva_id' => 1,
				'stock' => '10'
		]);
	}
}
