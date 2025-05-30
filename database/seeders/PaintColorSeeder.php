<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\PaintCategory;

class PaintColorSeeder extends Seeder
{

    public function run(): void
    {
        // Find Ultrashield category
        $ultra = PaintCategory::where('name', 'Ultrashield')->first();

        // Add some colors linked to Ultrashield
        $ultra->paints()->create(['name' => 'Quarry', 'code' => 'US6122']);
        $ultra->paints()->create(['name' => 'Misty Grey', 'code' => 'US6013']);
        $ultra->paints()->create(['name' => 'Ortize', 'code' => 'US6354']);
        $ultra->paints()->create(['name' => 'TNB Grey', 'code' => 'US6004']);
        $ultra->paints()->create(['name' => 'Harpy', 'code' => 'US6250']);
        $ultra->paints()->create(['name' => 'Shooting Star', 'code' => 'US6222']);
        $ultra->paints()->create(['name' => 'Gunmetal', 'code' => 'US6333']);
        $ultra->paints()->create(['name' => 'Tropical Cloud', 'code' => 'US6556']);
        $ultra->paints()->create(['name' => 'Rich Cream', 'code' => 'US6051']);
        $ultra->paints()->create(['name' => 'Classic Silk', 'code' => 'US6501']);
        $ultra->paints()->create(['name' => 'Sand Stone', 'code' => 'US6653']);
        $ultra->paints()->create(['name' => 'Stormy', 'code' => 'US6834']);
        $ultra->paints()->create(['name' => 'Vistusik Brown', 'code' => 'US6655']);
        $ultra->paints()->create(['name' => 'Cinnamon', 'code' => 'US6251']);
        $ultra->paints()->create(['name' => 'Fresh Green', 'code' => 'US6190']);
        $ultra->paints()->create(['name' => 'Savory', 'code' => 'US6350']);
        $ultra->paints()->create(['name' => 'Sejati', 'code' => 'US6010']);
        $ultra->paints()->create(['name' => 'Breen', 'code' => 'US6926']);
        $ultra->paints()->create(['name' => 'Tanzania', 'code' => 'US6598']);
        $ultra->paints()->create(['name' => 'CIBD Green', 'code' => 'US6007']);
        $ultra->paints()->create(['name' => 'Savanah', 'code' => 'US6345']);
        $ultra->paints()->create(['name' => 'Legacy', 'code' => 'US6022']);
        $ultra->paints()->create(['name' => 'Coriander', 'code' => 'US6042']);
        $ultra->paints()->create(['name' => 'Monterrey', 'code' => 'US6662']);
        $ultra->paints()->create(['name' => 'Golden Brown', 'code' => 'US6714']);
        $ultra->paints()->create(['name' => 'Classic Grey', 'code' => 'US6771']);
        $ultra->paints()->create(['name' => 'Tioman', 'code' => 'US6991']);
        $ultra->paints()->create(['name' => 'Horizon Teal', 'code' => 'US6877']);
        $ultra->paints()->create(['name' => 'Paradise Blue', 'code' => 'US6365']);
        $ultra->paints()->create(['name' => 'TNB Blue', 'code' => 'US6006']);
        $ultra->paints()->create(['name' => 'Wira Blue', 'code' => 'US6221']);
        $ultra->paints()->create(['name' => 'Banana', 'code' => 'US6138']);
        $ultra->paints()->create(['name' => 'French Linen', 'code' => 'US6535']);
        $ultra->paints()->create(['name' => 'Butterfly', 'code' => 'US6207']);
        $ultra->paints()->create(['name' => 'Daisy', 'code' => 'US6454']);
        $ultra->paints()->create(['name' => 'Gold', 'code' => 'US6453']);
        $ultra->paints()->create(['name' => 'Tangerine', 'code' => 'US6254']);
        $ultra->paints()->create(['name' => 'Chelsea', 'code' => 'US6235']);
        $ultra->paints()->create(['name' => 'Orange', 'code' => 'US6105']);
        $ultra->paints()->create(['name' => 'Brown Yellow', 'code' => 'US6027']);
        $ultra->paints()->create(['name' => 'Electric Orange', 'code' => 'US6073']);
        $ultra->paints()->create(['name' => 'Pumkin', 'code' => 'US6152']);
        $ultra->paints()->create(['name' => 'Apricot', 'code' => 'US6135']);
        $ultra->paints()->create(['name' => 'Calypso', 'code' => 'US6255']);
        $ultra->paints()->create(['name' => 'Duchess', 'code' => 'US6258']);
        $ultra->paints()->create(['name' => 'Tomato', 'code' => 'US6565']);
        $ultra->paints()->create(['name' => 'TNB Red', 'code' => 'US6005']);
        $ultra->paints()->create(['name' => 'Terra Cotta', 'code' => 'US6199']);

        $ultra = PaintCategory::where('name', 'Kalershield')->first();
        
        $ultra->paints()->create(['name' => 'Corn Silk', 'code' => 'KS6138']);
        $ultra->paints()->create(['name' => 'orange', 'code' => 'KS6105']);
        $ultra->paints()->create(['name' => 'Orange Beddar', 'code' => 'KS6994']);
        $ultra->paints()->create(['name' => 'Orange Torch', 'code' => 'KS61536']);
        $ultra->paints()->create(['name' => 'Janes Grey', 'code' => 'KS6491']);
        $ultra->paints()->create(['name' => 'Oakroot', 'code' => 'KS61664']);
        $ultra->paints()->create(['name' => 'Mocha', 'code' => 'KS6251']);
        $ultra->paints()->create(['name' => 'Classic Beam', 'code' => 'KS6771']);
        $ultra->paints()->create(['name' => 'Lite Grey', 'code' => 'KS6122']);
        $ultra->paints()->create(['name' => 'Bright Grey', 'code' => 'KS6222']);
        $ultra->paints()->create(['name' => 'Puritan Black', 'code' => 'KS6494']);
        $ultra->paints()->create(['name' => 'Excalibur', 'code' => 'KS6333']);
        $ultra->paints()->create(['name' => 'Transition Yellow', 'code' => 'KS61519']);
        $ultra->paints()->create(['name' => 'Baby Lemon', 'code' => 'KS6008']);
        $ultra->paints()->create(['name' => 'Lemon Chiffon', 'code' => 'KS6535']);
        $ultra->paints()->create(['name' => 'Elation', 'code' => 'KS6774']);
        $ultra->paints()->create(['name' => 'Green Peer', 'code' => 'KS6017']);
        $ultra->paints()->create(['name' => 'Pickle', 'code' => 'KS6598']);

        $ultra = PaintCategory::where('name', 'Supercoat')->first();

        $ultra->paints()->create(['name' => 'Apple White', 'code' => 'SC1191']);
        $ultra->paints()->create(['name' => 'Lily White', 'code' => 'SC1192']);
        $ultra->paints()->create(['name' => 'Sweet Corn', 'code' => 'SC1223']);
        $ultra->paints()->create(['name' => 'Linen', 'code' => 'SC1393']);
        $ultra->paints()->create(['name' => 'Sun Flower', 'code' => 'SC1180']);
        $ultra->paints()->create(['name' => 'Ribbon Yellow', 'code' => 'SC1456']);
        $ultra->paints()->create(['name' => 'Kasturi', 'code' => 'SC1889']);
        $ultra->paints()->create(['name' => 'Brila', 'code' => 'SC1856']);
        $ultra->paints()->create(['name' => 'Green Grape', 'code' => 'SC1603']);
        $ultra->paints()->create(['name' => 'Owen', 'code' => 'SC1333']);
        $ultra->paints()->create(['name' => 'Sand Stone', 'code' => 'SC1653']);
        $ultra->paints()->create(['name' => 'Intense', 'code' => 'SC1677']);
        $ultra->paints()->create(['name' => 'Metafora', 'code' => 'SC1658']);
        $ultra->paints()->create(['name' => 'Realiza', 'code' => 'SC1685']);
        $ultra->paints()->create(['name' => 'Momento', 'code' => 'SC1673']);
        $ultra->paints()->create(['name' => 'Tinkerbell', 'code' => 'SC1204']);
        $ultra->paints()->create(['name' => 'Bluemoon ', 'code' => 'SC1246']);
        $ultra->paints()->create(['name' => 'Maradona', 'code' => 'SC1366']);
        $ultra->paints()->create(['name' => 'Alonso', 'code' => 'SC1455']);
        $ultra->paints()->create(['name' => 'Celtic', 'code' => 'SC344']);
        $ultra->paints()->create(['name' => 'Roma', 'code' => 'SC1368']);
        $ultra->paints()->create(['name' => 'Hot Pink', 'code' => 'SC1197']);
        $ultra->paints()->create(['name' => 'Early Down', 'code' => 'SC1342']);
        $ultra->paints()->create(['name' => 'Stevig', 'code' => 'SC1953']);
        $ultra->paints()->create(['name' => 'Melarosa', 'code' => 'SC1980']);
        $ultra->paints()->create(['name' => 'Summer Heat', 'code' => 'SC1284']);
        $ultra->paints()->create(['name' => 'Nectar', 'code' => 'SC1073']);
        $ultra->paints()->create(['name' => 'Beckham', 'code' => 'SC1112']);
        $ultra->paints()->create(['name' => 'Forene', 'code' => 'SC1785']);
        $ultra->paints()->create(['name' => 'Orange Blossom', 'code' => 'SC1254']);
        $ultra->paints()->create(['name' => 'Vanila', 'code' => 'SC1367']);
        $ultra->paints()->create(['name' => 'Lampard', 'code' => 'SC1532']);
        $ultra->paints()->create(['name' => 'Sincere', 'code' => 'SC1877']);
        $ultra->paints()->create(['name' => 'Eggshell', 'code' => 'SC1369']);
        $ultra->paints()->create(['name' => 'Vistusik Brown', 'code' => 'SC1655']);
        $ultra->paints()->create(['name' => 'Flakes', 'code' => 'SC1795']);
        $ultra->paints()->create(['name' => 'Sense', 'code' => 'SC1875']);

        $ultra = PaintCategory::where('name', 'Maxicoat')->first();

        $ultra->paints()->create(['name' => 'Ungu Muda', 'code' => 'MC3257']);
        $ultra->paints()->create(['name' => 'Violet Petal', 'code' => 'MC3520']);
        $ultra->paints()->create(['name' => 'Love Me Do', 'code' => 'MC3563']);
        $ultra->paints()->create(['name' => 'Grape Juice', 'code' => 'MC3607']);
        $ultra->paints()->create(['name' => 'Candilac Pink', 'code' => 'MC3705']);
        $ultra->paints()->create(['name' => 'Flamingo', 'code' => 'MC3196']);
        $ultra->paints()->create(['name' => 'Tickle Pink', 'code' => 'MC3765']);
        $ultra->paints()->create(['name' => 'Velvet Red', 'code' => 'MC3201']);
        $ultra->paints()->create(['name' => 'Sour Apple', 'code' => 'MC3492']);
        $ultra->paints()->create(['name' => 'Pucuk Pisang', 'code' => 'MC3374']);
        $ultra->paints()->create(['name' => 'Flygreen', 'code' => 'MC3489']);
        $ultra->paints()->create(['name' => 'Indulge Green', 'code' => 'MC3582']);
        $ultra->paints()->create(['name' => 'Fresh Mint', 'code' => 'MC3622']);
        $ultra->paints()->create(['name' => 'Acadia Green', 'code' => 'MC3623']);
        $ultra->paints()->create(['name' => 'Gembo Green', 'code' => 'MC3807']);
        $ultra->paints()->create(['name' => 'Green Hil', 'code' => 'MC3665']);
        $ultra->paints()->create(['name' => 'Marble Grey', 'code' => 'MC3535']);
        $ultra->paints()->create(['name' => 'Haze Blue', 'code' => 'MC3643']);
        $ultra->paints()->create(['name' => 'In The Rain', 'code' => 'MC3283']);
        $ultra->paints()->create(['name' => 'Fluffy Blue', 'code' => 'MC3549']);
        $ultra->paints()->create(['name' => 'Sky Chrome', 'code' => 'MC3541']);
        $ultra->paints()->create(['name' => 'Silver Sage', 'code' => 'MC3527']);
        $ultra->paints()->create(['name' => 'Dextrius', 'code' => 'MC3112']);
        $ultra->paints()->create(['name' => 'Sahara Gold', 'code' => 'MC3409']);
        $ultra->paints()->create(['name' => 'Sunny Yellow', 'code' => 'MC3123']);
        $ultra->paints()->create(['name' => 'Peanut Brown', 'code' => 'MC3131']);
        $ultra->paints()->create(['name' => 'Fizzy Lime', 'code' => 'MC3120']);
        $ultra->paints()->create(['name' => 'Selamanya', 'code' => 'MC3127']);
        $ultra->paints()->create(['name' => 'Electronic', 'code' => 'MC3155']);
        $ultra->paints()->create(['name' => 'Peach Trail', 'code' => 'MC3713']);
        $ultra->paints()->create(['name' => 'Havana', 'code' => 'MC3675']);
        $ultra->paints()->create(['name' => 'Dark Nut', 'code' => 'MC3655']);
        $ultra->paints()->create(['name' => 'Dahlia', 'code' => 'MC3499']);
        $ultra->paints()->create(['name' => 'Hint of Cream', 'code' => 'MC3506']);
        $ultra->paints()->create(['name' => 'Cream', 'code' => 'MC3500']);
        $ultra->paints()->create(['name' => 'Desert', 'code' => 'MC3685']);
        $ultra->paints()->create(['name' => 'Cliff Brown', 'code' => 'MC3521']);
        $ultra->paints()->create(['name' => 'Rich Clay', 'code' => 'MC3484']);

        $ultra = PaintCategory::where('name', 'Maxicoat Lite')->first();

        $ultra->paints()->create(['name' => 'Lite Linen', 'code' => 'MCL7003']);
        $ultra->paints()->create(['name' => 'Litness', 'code' => 'MCL7004']);
        $ultra->paints()->create(['name' => 'Flava', 'code' => 'MCL7005']);
        $ultra->paints()->create(['name' => 'Melur', 'code' => 'MCL7006']);
        $ultra->paints()->create(['name' => 'Lite Corn', 'code' => 'MCL7007']);
        $ultra->paints()->create(['name' => 'Daffodil', 'code' => 'MCL7008']);
        $ultra->paints()->create(['name' => 'Frosty Pink', 'code' => 'MCL7009']);
        $ultra->paints()->create(['name' => 'Fluffy Pink', 'code' => 'MCL7010']);
        $ultra->paints()->create(['name' => 'Lisabella', 'code' => 'MCL7011']);
        $ultra->paints()->create(['name' => 'Truly', 'code' => 'MCL7012']);
        $ultra->paints()->create(['name' => 'Madly', 'code' => 'MCL7013']);
        $ultra->paints()->create(['name' => 'Deeply', 'code' => 'MCL7014']);
        $ultra->paints()->create(['name' => 'Wispy', 'code' => 'MCL7015']);
        $ultra->paints()->create(['name' => 'Tropicana', 'code' => 'MCL7016']);
        $ultra->paints()->create(['name' => 'Ara Hil', 'code' => 'MCL7017']);
        $ultra->paints()->create(['name' => 'Wisdom', 'code' => 'MCL7018']);
        $ultra->paints()->create(['name' => 'Glorious', 'code' => 'MCL7019']);
        $ultra->paints()->create(['name' => 'Ocean Waze', 'code' => 'MCL7020']);
        $ultra->paints()->create(['name' => 'Vista', 'code' => 'MCL7024']);
        $ultra->paints()->create(['name' => 'Tulips', 'code' => 'MCL7025']);
        $ultra->paints()->create(['name' => 'Violette', 'code' => 'MCL7026']);
        $ultra->paints()->create(['name' => 'Gratitude', 'code' => 'MCL7012']);
        $ultra->paints()->create(['name' => 'Organic Pink', 'code' => 'MCL7022']);
        $ultra->paints()->create(['name' => 'Terra Seed', 'code' => 'MCL7023']);
        $ultra->paints()->create(['name' => 'Sirus', 'code' => 'MCL7027']);
        $ultra->paints()->create(['name' => 'Turn On', 'code' => 'MCL7028']);
        $ultra->paints()->create(['name' => 'Thundercloud', 'code' => 'MCL7029']);

        $ultra = PaintCategory::where('name', 'Glomel')->first();

        $ultra->paints()->create(['name' => 'Mandarin', 'code' => 'CM2331']);
        $ultra->paints()->create(['name' => 'Signal Red', 'code' => 'CM2402']);
        $ultra->paints()->create(['name' => 'Flamingo', 'code' => 'CM2432']);
        $ultra->paints()->create(['name' => 'TNB Red', 'code' => 'CM2005']);
        $ultra->paints()->create(['name' => 'Plum Red', 'code' => 'CM2154']);
        $ultra->paints()->create(['name' => 'Carnival Red', 'code' => 'GM2507']);
        $ultra->paints()->create(['name' => 'Barbary Gold', 'code' => 'GM2329']);
        $ultra->paints()->create(['name' => 'Camel', 'code' => 'GM2070']);
        $ultra->paints()->create(['name' => 'Oak', 'code' => 'GM2322']);
        $ultra->paints()->create(['name' => 'Russet Brown', 'code' => 'GM2332']);
        $ultra->paints()->create(['name' => 'Mahogany', 'code' => 'GM2136']);
        $ultra->paints()->create(['name' => 'Chocolate', 'code' => 'GM2222']);
        $ultra->paints()->create(['name' => 'Ash Grey', 'code' => 'GM2306']);
        $ultra->paints()->create(['name' => 'Venus', 'code' => 'GM2406']);
        $ultra->paints()->create(['name' => 'TNB Grey', 'code' => 'GM2004']);
        $ultra->paints()->create(['name' => 'Exec Grey', 'code' => 'GM2335']);
        $ultra->paints()->create(['name' => 'Papier Grey', 'code' => 'GM2139']);
        $ultra->paints()->create(['name' => 'Nightfall', 'code' => 'GM2182']);
        $ultra->paints()->create(['name' => 'Off White', 'code' => 'GM2300']);
        $ultra->paints()->create(['name' => 'Ivory White', 'code' => 'GM2300']);
        $ultra->paints()->create(['name' => 'Cream', 'code' => 'GM2363']);
        $ultra->paints()->create(['name' => 'Maple', 'code' => 'GM2366']);
        $ultra->paints()->create(['name' => 'Turquoise', 'code' => 'GM2401']);
        $ultra->paints()->create(['name' => 'Pearl Blue', 'code' => 'GM2477']);
        $ultra->paints()->create(['name' => 'Paradise Blue', 'code' => 'GM2365']);
        $ultra->paints()->create(['name' => 'TNB Blue', 'code' => 'GM2006']);
        $ultra->paints()->create(['name' => 'Haze Green', 'code' => 'GM2117']);
        $ultra->paints()->create(['name' => 'Grassy', 'code' => 'GM2560']);
        $ultra->paints()->create(['name' => 'Olive', 'code' => 'GM2653']);
        $ultra->paints()->create(['name' => 'Conifer', 'code' => 'GM2509']);
        $ultra->paints()->create(['name' => 'Spruce', 'code' => 'GM2510']);

    }
}
