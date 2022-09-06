<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class PRoleHasPermissionsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('p_role_has_permissions')->delete();
        
        \DB::table('p_role_has_permissions')->insert(array (
            0 => 
            array (
                'permission_id' => 1,
                'role_id' => 1,
            ),
            1 => 
            array (
                'permission_id' => 1,
                'role_id' => 3,
            ),
            2 => 
            array (
                'permission_id' => 1,
                'role_id' => 4,
            ),
            3 => 
            array (
                'permission_id' => 1,
                'role_id' => 5,
            ),
            4 => 
            array (
                'permission_id' => 1,
                'role_id' => 6,
            ),
            5 => 
            array (
                'permission_id' => 1,
                'role_id' => 7,
            ),
            6 => 
            array (
                'permission_id' => 2,
                'role_id' => 3,
            ),
            7 => 
            array (
                'permission_id' => 2,
                'role_id' => 4,
            ),
            8 => 
            array (
                'permission_id' => 2,
                'role_id' => 5,
            ),
            9 => 
            array (
                'permission_id' => 2,
                'role_id' => 6,
            ),
            10 => 
            array (
                'permission_id' => 2,
                'role_id' => 7,
            ),
            11 => 
            array (
                'permission_id' => 3,
                'role_id' => 4,
            ),
            12 => 
            array (
                'permission_id' => 4,
                'role_id' => 4,
            ),
            13 => 
            array (
                'permission_id' => 5,
                'role_id' => 4,
            ),
            14 => 
            array (
                'permission_id' => 6,
                'role_id' => 4,
            ),
            15 => 
            array (
                'permission_id' => 7,
                'role_id' => 3,
            ),
            16 => 
            array (
                'permission_id' => 7,
                'role_id' => 4,
            ),
            17 => 
            array (
                'permission_id' => 7,
                'role_id' => 5,
            ),
            18 => 
            array (
                'permission_id' => 7,
                'role_id' => 6,
            ),
            19 => 
            array (
                'permission_id' => 7,
                'role_id' => 7,
            ),
            20 => 
            array (
                'permission_id' => 12,
                'role_id' => 3,
            ),
            21 => 
            array (
                'permission_id' => 12,
                'role_id' => 4,
            ),
            22 => 
            array (
                'permission_id' => 12,
                'role_id' => 5,
            ),
            23 => 
            array (
                'permission_id' => 12,
                'role_id' => 6,
            ),
            24 => 
            array (
                'permission_id' => 12,
                'role_id' => 7,
            ),
            25 => 
            array (
                'permission_id' => 17,
                'role_id' => 3,
            ),
            26 => 
            array (
                'permission_id' => 17,
                'role_id' => 4,
            ),
            27 => 
            array (
                'permission_id' => 17,
                'role_id' => 5,
            ),
            28 => 
            array (
                'permission_id' => 17,
                'role_id' => 6,
            ),
            29 => 
            array (
                'permission_id' => 17,
                'role_id' => 7,
            ),
            30 => 
            array (
                'permission_id' => 22,
                'role_id' => 3,
            ),
            31 => 
            array (
                'permission_id' => 22,
                'role_id' => 4,
            ),
            32 => 
            array (
                'permission_id' => 22,
                'role_id' => 5,
            ),
            33 => 
            array (
                'permission_id' => 22,
                'role_id' => 6,
            ),
            34 => 
            array (
                'permission_id' => 22,
                'role_id' => 7,
            ),
            35 => 
            array (
                'permission_id' => 27,
                'role_id' => 3,
            ),
            36 => 
            array (
                'permission_id' => 27,
                'role_id' => 4,
            ),
            37 => 
            array (
                'permission_id' => 27,
                'role_id' => 5,
            ),
            38 => 
            array (
                'permission_id' => 27,
                'role_id' => 6,
            ),
            39 => 
            array (
                'permission_id' => 27,
                'role_id' => 7,
            ),
            40 => 
            array (
                'permission_id' => 33,
                'role_id' => 3,
            ),
            41 => 
            array (
                'permission_id' => 33,
                'role_id' => 4,
            ),
            42 => 
            array (
                'permission_id' => 33,
                'role_id' => 5,
            ),
            43 => 
            array (
                'permission_id' => 33,
                'role_id' => 6,
            ),
            44 => 
            array (
                'permission_id' => 33,
                'role_id' => 7,
            ),
            45 => 
            array (
                'permission_id' => 38,
                'role_id' => 3,
            ),
            46 => 
            array (
                'permission_id' => 38,
                'role_id' => 4,
            ),
            47 => 
            array (
                'permission_id' => 38,
                'role_id' => 5,
            ),
            48 => 
            array (
                'permission_id' => 38,
                'role_id' => 6,
            ),
            49 => 
            array (
                'permission_id' => 38,
                'role_id' => 7,
            ),
            50 => 
            array (
                'permission_id' => 43,
                'role_id' => 3,
            ),
            51 => 
            array (
                'permission_id' => 43,
                'role_id' => 4,
            ),
            52 => 
            array (
                'permission_id' => 43,
                'role_id' => 5,
            ),
            53 => 
            array (
                'permission_id' => 43,
                'role_id' => 6,
            ),
            54 => 
            array (
                'permission_id' => 43,
                'role_id' => 7,
            ),
            55 => 
            array (
                'permission_id' => 47,
                'role_id' => 3,
            ),
            56 => 
            array (
                'permission_id' => 47,
                'role_id' => 4,
            ),
            57 => 
            array (
                'permission_id' => 47,
                'role_id' => 5,
            ),
            58 => 
            array (
                'permission_id' => 47,
                'role_id' => 6,
            ),
            59 => 
            array (
                'permission_id' => 47,
                'role_id' => 7,
            ),
            60 => 
            array (
                'permission_id' => 48,
                'role_id' => 3,
            ),
            61 => 
            array (
                'permission_id' => 48,
                'role_id' => 4,
            ),
            62 => 
            array (
                'permission_id' => 48,
                'role_id' => 5,
            ),
            63 => 
            array (
                'permission_id' => 48,
                'role_id' => 6,
            ),
            64 => 
            array (
                'permission_id' => 48,
                'role_id' => 7,
            ),
            65 => 
            array (
                'permission_id' => 55,
                'role_id' => 3,
            ),
            66 => 
            array (
                'permission_id' => 55,
                'role_id' => 4,
            ),
            67 => 
            array (
                'permission_id' => 55,
                'role_id' => 5,
            ),
            68 => 
            array (
                'permission_id' => 55,
                'role_id' => 6,
            ),
            69 => 
            array (
                'permission_id' => 55,
                'role_id' => 7,
            ),
            70 => 
            array (
                'permission_id' => 59,
                'role_id' => 3,
            ),
            71 => 
            array (
                'permission_id' => 59,
                'role_id' => 4,
            ),
            72 => 
            array (
                'permission_id' => 59,
                'role_id' => 5,
            ),
            73 => 
            array (
                'permission_id' => 59,
                'role_id' => 6,
            ),
            74 => 
            array (
                'permission_id' => 59,
                'role_id' => 7,
            ),
            75 => 
            array (
                'permission_id' => 61,
                'role_id' => 3,
            ),
            76 => 
            array (
                'permission_id' => 61,
                'role_id' => 4,
            ),
            77 => 
            array (
                'permission_id' => 61,
                'role_id' => 5,
            ),
            78 => 
            array (
                'permission_id' => 61,
                'role_id' => 6,
            ),
            79 => 
            array (
                'permission_id' => 61,
                'role_id' => 7,
            ),
            80 => 
            array (
                'permission_id' => 63,
                'role_id' => 4,
            ),
            81 => 
            array (
                'permission_id' => 64,
                'role_id' => 4,
            ),
            82 => 
            array (
                'permission_id' => 65,
                'role_id' => 4,
            ),
            83 => 
            array (
                'permission_id' => 66,
                'role_id' => 3,
            ),
            84 => 
            array (
                'permission_id' => 66,
                'role_id' => 4,
            ),
            85 => 
            array (
                'permission_id' => 66,
                'role_id' => 5,
            ),
            86 => 
            array (
                'permission_id' => 66,
                'role_id' => 6,
            ),
            87 => 
            array (
                'permission_id' => 66,
                'role_id' => 7,
            ),
            88 => 
            array (
                'permission_id' => 70,
                'role_id' => 3,
            ),
            89 => 
            array (
                'permission_id' => 70,
                'role_id' => 4,
            ),
            90 => 
            array (
                'permission_id' => 70,
                'role_id' => 5,
            ),
            91 => 
            array (
                'permission_id' => 70,
                'role_id' => 6,
            ),
            92 => 
            array (
                'permission_id' => 70,
                'role_id' => 7,
            ),
            93 => 
            array (
                'permission_id' => 74,
                'role_id' => 3,
            ),
            94 => 
            array (
                'permission_id' => 74,
                'role_id' => 4,
            ),
            95 => 
            array (
                'permission_id' => 74,
                'role_id' => 5,
            ),
            96 => 
            array (
                'permission_id' => 74,
                'role_id' => 6,
            ),
            97 => 
            array (
                'permission_id' => 74,
                'role_id' => 7,
            ),
            98 => 
            array (
                'permission_id' => 78,
                'role_id' => 3,
            ),
            99 => 
            array (
                'permission_id' => 78,
                'role_id' => 4,
            ),
            100 => 
            array (
                'permission_id' => 78,
                'role_id' => 5,
            ),
            101 => 
            array (
                'permission_id' => 78,
                'role_id' => 6,
            ),
            102 => 
            array (
                'permission_id' => 78,
                'role_id' => 7,
            ),
            103 => 
            array (
                'permission_id' => 79,
                'role_id' => 4,
            ),
            104 => 
            array (
                'permission_id' => 80,
                'role_id' => 4,
            ),
            105 => 
            array (
                'permission_id' => 81,
                'role_id' => 4,
            ),
            106 => 
            array (
                'permission_id' => 82,
                'role_id' => 3,
            ),
            107 => 
            array (
                'permission_id' => 82,
                'role_id' => 4,
            ),
            108 => 
            array (
                'permission_id' => 82,
                'role_id' => 5,
            ),
            109 => 
            array (
                'permission_id' => 82,
                'role_id' => 6,
            ),
            110 => 
            array (
                'permission_id' => 82,
                'role_id' => 7,
            ),
            111 => 
            array (
                'permission_id' => 83,
                'role_id' => 4,
            ),
            112 => 
            array (
                'permission_id' => 84,
                'role_id' => 4,
            ),
            113 => 
            array (
                'permission_id' => 85,
                'role_id' => 4,
            ),
            114 => 
            array (
                'permission_id' => 86,
                'role_id' => 3,
            ),
            115 => 
            array (
                'permission_id' => 86,
                'role_id' => 4,
            ),
            116 => 
            array (
                'permission_id' => 86,
                'role_id' => 5,
            ),
            117 => 
            array (
                'permission_id' => 86,
                'role_id' => 6,
            ),
            118 => 
            array (
                'permission_id' => 86,
                'role_id' => 7,
            ),
            119 => 
            array (
                'permission_id' => 89,
                'role_id' => 3,
            ),
            120 => 
            array (
                'permission_id' => 89,
                'role_id' => 4,
            ),
            121 => 
            array (
                'permission_id' => 89,
                'role_id' => 5,
            ),
            122 => 
            array (
                'permission_id' => 89,
                'role_id' => 6,
            ),
            123 => 
            array (
                'permission_id' => 89,
                'role_id' => 7,
            ),
            124 => 
            array (
                'permission_id' => 94,
                'role_id' => 3,
            ),
            125 => 
            array (
                'permission_id' => 94,
                'role_id' => 4,
            ),
            126 => 
            array (
                'permission_id' => 94,
                'role_id' => 5,
            ),
            127 => 
            array (
                'permission_id' => 94,
                'role_id' => 6,
            ),
            128 => 
            array (
                'permission_id' => 94,
                'role_id' => 7,
            ),
            129 => 
            array (
                'permission_id' => 97,
                'role_id' => 3,
            ),
            130 => 
            array (
                'permission_id' => 97,
                'role_id' => 4,
            ),
            131 => 
            array (
                'permission_id' => 97,
                'role_id' => 5,
            ),
            132 => 
            array (
                'permission_id' => 97,
                'role_id' => 6,
            ),
            133 => 
            array (
                'permission_id' => 97,
                'role_id' => 7,
            ),
            134 => 
            array (
                'permission_id' => 102,
                'role_id' => 3,
            ),
            135 => 
            array (
                'permission_id' => 102,
                'role_id' => 4,
            ),
            136 => 
            array (
                'permission_id' => 102,
                'role_id' => 5,
            ),
            137 => 
            array (
                'permission_id' => 102,
                'role_id' => 6,
            ),
            138 => 
            array (
                'permission_id' => 102,
                'role_id' => 7,
            ),
            139 => 
            array (
                'permission_id' => 109,
                'role_id' => 3,
            ),
            140 => 
            array (
                'permission_id' => 109,
                'role_id' => 4,
            ),
            141 => 
            array (
                'permission_id' => 109,
                'role_id' => 5,
            ),
            142 => 
            array (
                'permission_id' => 109,
                'role_id' => 6,
            ),
            143 => 
            array (
                'permission_id' => 109,
                'role_id' => 7,
            ),
            144 => 
            array (
                'permission_id' => 110,
                'role_id' => 3,
            ),
            145 => 
            array (
                'permission_id' => 110,
                'role_id' => 4,
            ),
            146 => 
            array (
                'permission_id' => 110,
                'role_id' => 5,
            ),
            147 => 
            array (
                'permission_id' => 110,
                'role_id' => 6,
            ),
            148 => 
            array (
                'permission_id' => 110,
                'role_id' => 7,
            ),
            149 => 
            array (
                'permission_id' => 135,
                'role_id' => 3,
            ),
            150 => 
            array (
                'permission_id' => 135,
                'role_id' => 4,
            ),
            151 => 
            array (
                'permission_id' => 135,
                'role_id' => 5,
            ),
            152 => 
            array (
                'permission_id' => 135,
                'role_id' => 6,
            ),
            153 => 
            array (
                'permission_id' => 135,
                'role_id' => 7,
            ),
            154 => 
            array (
                'permission_id' => 136,
                'role_id' => 3,
            ),
            155 => 
            array (
                'permission_id' => 136,
                'role_id' => 5,
            ),
            156 => 
            array (
                'permission_id' => 136,
                'role_id' => 6,
            ),
            157 => 
            array (
                'permission_id' => 136,
                'role_id' => 7,
            ),
            158 => 
            array (
                'permission_id' => 137,
                'role_id' => 3,
            ),
            159 => 
            array (
                'permission_id' => 137,
                'role_id' => 4,
            ),
            160 => 
            array (
                'permission_id' => 137,
                'role_id' => 5,
            ),
            161 => 
            array (
                'permission_id' => 137,
                'role_id' => 6,
            ),
            162 => 
            array (
                'permission_id' => 137,
                'role_id' => 7,
            ),
            163 => 
            array (
                'permission_id' => 145,
                'role_id' => 4,
            ),
            164 => 
            array (
                'permission_id' => 147,
                'role_id' => 3,
            ),
            165 => 
            array (
                'permission_id' => 147,
                'role_id' => 4,
            ),
            166 => 
            array (
                'permission_id' => 147,
                'role_id' => 5,
            ),
            167 => 
            array (
                'permission_id' => 147,
                'role_id' => 6,
            ),
            168 => 
            array (
                'permission_id' => 147,
                'role_id' => 7,
            ),
            169 => 
            array (
                'permission_id' => 148,
                'role_id' => 3,
            ),
            170 => 
            array (
                'permission_id' => 148,
                'role_id' => 4,
            ),
            171 => 
            array (
                'permission_id' => 148,
                'role_id' => 5,
            ),
            172 => 
            array (
                'permission_id' => 148,
                'role_id' => 7,
            ),
            173 => 
            array (
                'permission_id' => 149,
                'role_id' => 3,
            ),
            174 => 
            array (
                'permission_id' => 149,
                'role_id' => 4,
            ),
            175 => 
            array (
                'permission_id' => 149,
                'role_id' => 5,
            ),
            176 => 
            array (
                'permission_id' => 149,
                'role_id' => 7,
            ),
            177 => 
            array (
                'permission_id' => 150,
                'role_id' => 3,
            ),
            178 => 
            array (
                'permission_id' => 150,
                'role_id' => 4,
            ),
            179 => 
            array (
                'permission_id' => 150,
                'role_id' => 5,
            ),
            180 => 
            array (
                'permission_id' => 150,
                'role_id' => 7,
            ),
            181 => 
            array (
                'permission_id' => 151,
                'role_id' => 3,
            ),
            182 => 
            array (
                'permission_id' => 151,
                'role_id' => 4,
            ),
            183 => 
            array (
                'permission_id' => 151,
                'role_id' => 5,
            ),
            184 => 
            array (
                'permission_id' => 151,
                'role_id' => 6,
            ),
            185 => 
            array (
                'permission_id' => 151,
                'role_id' => 7,
            ),
            186 => 
            array (
                'permission_id' => 152,
                'role_id' => 4,
            ),
            187 => 
            array (
                'permission_id' => 153,
                'role_id' => 4,
            ),
            188 => 
            array (
                'permission_id' => 154,
                'role_id' => 4,
            ),
            189 => 
            array (
                'permission_id' => 155,
                'role_id' => 7,
            ),
        ));
        
        
    }
}