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
                'role_id' => 4,
            ),
            2 => 
            array (
                'permission_id' => 1,
                'role_id' => 5,
            ),
            3 => 
            array (
                'permission_id' => 1,
                'role_id' => 6,
            ),
            4 => 
            array (
                'permission_id' => 1,
                'role_id' => 7,
            ),
            5 => 
            array (
                'permission_id' => 1,
                'role_id' => 11,
            ),
            6 => 
            array (
                'permission_id' => 1,
                'role_id' => 12,
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
                'permission_id' => 2,
                'role_id' => 11,
            ),
            12 => 
            array (
                'permission_id' => 2,
                'role_id' => 12,
            ),
            13 => 
            array (
                'permission_id' => 3,
                'role_id' => 4,
            ),
            14 => 
            array (
                'permission_id' => 3,
                'role_id' => 11,
            ),
            15 => 
            array (
                'permission_id' => 3,
                'role_id' => 12,
            ),
            16 => 
            array (
                'permission_id' => 4,
                'role_id' => 4,
            ),
            17 => 
            array (
                'permission_id' => 4,
                'role_id' => 11,
            ),
            18 => 
            array (
                'permission_id' => 4,
                'role_id' => 12,
            ),
            19 => 
            array (
                'permission_id' => 5,
                'role_id' => 4,
            ),
            20 => 
            array (
                'permission_id' => 5,
                'role_id' => 11,
            ),
            21 => 
            array (
                'permission_id' => 5,
                'role_id' => 12,
            ),
            22 => 
            array (
                'permission_id' => 6,
                'role_id' => 4,
            ),
            23 => 
            array (
                'permission_id' => 6,
                'role_id' => 11,
            ),
            24 => 
            array (
                'permission_id' => 6,
                'role_id' => 12,
            ),
            25 => 
            array (
                'permission_id' => 7,
                'role_id' => 4,
            ),
            26 => 
            array (
                'permission_id' => 7,
                'role_id' => 5,
            ),
            27 => 
            array (
                'permission_id' => 7,
                'role_id' => 6,
            ),
            28 => 
            array (
                'permission_id' => 7,
                'role_id' => 7,
            ),
            29 => 
            array (
                'permission_id' => 7,
                'role_id' => 11,
            ),
            30 => 
            array (
                'permission_id' => 7,
                'role_id' => 12,
            ),
            31 => 
            array (
                'permission_id' => 9,
                'role_id' => 11,
            ),
            32 => 
            array (
                'permission_id' => 9,
                'role_id' => 12,
            ),
            33 => 
            array (
                'permission_id' => 10,
                'role_id' => 11,
            ),
            34 => 
            array (
                'permission_id' => 10,
                'role_id' => 12,
            ),
            35 => 
            array (
                'permission_id' => 11,
                'role_id' => 11,
            ),
            36 => 
            array (
                'permission_id' => 11,
                'role_id' => 12,
            ),
            37 => 
            array (
                'permission_id' => 12,
                'role_id' => 4,
            ),
            38 => 
            array (
                'permission_id' => 12,
                'role_id' => 5,
            ),
            39 => 
            array (
                'permission_id' => 12,
                'role_id' => 6,
            ),
            40 => 
            array (
                'permission_id' => 12,
                'role_id' => 7,
            ),
            41 => 
            array (
                'permission_id' => 12,
                'role_id' => 11,
            ),
            42 => 
            array (
                'permission_id' => 12,
                'role_id' => 12,
            ),
            43 => 
            array (
                'permission_id' => 14,
                'role_id' => 11,
            ),
            44 => 
            array (
                'permission_id' => 14,
                'role_id' => 12,
            ),
            45 => 
            array (
                'permission_id' => 15,
                'role_id' => 11,
            ),
            46 => 
            array (
                'permission_id' => 15,
                'role_id' => 12,
            ),
            47 => 
            array (
                'permission_id' => 16,
                'role_id' => 11,
            ),
            48 => 
            array (
                'permission_id' => 16,
                'role_id' => 12,
            ),
            49 => 
            array (
                'permission_id' => 17,
                'role_id' => 4,
            ),
            50 => 
            array (
                'permission_id' => 17,
                'role_id' => 5,
            ),
            51 => 
            array (
                'permission_id' => 17,
                'role_id' => 6,
            ),
            52 => 
            array (
                'permission_id' => 17,
                'role_id' => 7,
            ),
            53 => 
            array (
                'permission_id' => 17,
                'role_id' => 11,
            ),
            54 => 
            array (
                'permission_id' => 17,
                'role_id' => 12,
            ),
            55 => 
            array (
                'permission_id' => 19,
                'role_id' => 11,
            ),
            56 => 
            array (
                'permission_id' => 19,
                'role_id' => 12,
            ),
            57 => 
            array (
                'permission_id' => 20,
                'role_id' => 11,
            ),
            58 => 
            array (
                'permission_id' => 20,
                'role_id' => 12,
            ),
            59 => 
            array (
                'permission_id' => 21,
                'role_id' => 11,
            ),
            60 => 
            array (
                'permission_id' => 21,
                'role_id' => 12,
            ),
            61 => 
            array (
                'permission_id' => 22,
                'role_id' => 4,
            ),
            62 => 
            array (
                'permission_id' => 22,
                'role_id' => 5,
            ),
            63 => 
            array (
                'permission_id' => 22,
                'role_id' => 6,
            ),
            64 => 
            array (
                'permission_id' => 22,
                'role_id' => 7,
            ),
            65 => 
            array (
                'permission_id' => 22,
                'role_id' => 11,
            ),
            66 => 
            array (
                'permission_id' => 22,
                'role_id' => 12,
            ),
            67 => 
            array (
                'permission_id' => 24,
                'role_id' => 11,
            ),
            68 => 
            array (
                'permission_id' => 24,
                'role_id' => 12,
            ),
            69 => 
            array (
                'permission_id' => 25,
                'role_id' => 11,
            ),
            70 => 
            array (
                'permission_id' => 25,
                'role_id' => 12,
            ),
            71 => 
            array (
                'permission_id' => 26,
                'role_id' => 11,
            ),
            72 => 
            array (
                'permission_id' => 26,
                'role_id' => 12,
            ),
            73 => 
            array (
                'permission_id' => 27,
                'role_id' => 4,
            ),
            74 => 
            array (
                'permission_id' => 27,
                'role_id' => 5,
            ),
            75 => 
            array (
                'permission_id' => 27,
                'role_id' => 6,
            ),
            76 => 
            array (
                'permission_id' => 27,
                'role_id' => 7,
            ),
            77 => 
            array (
                'permission_id' => 27,
                'role_id' => 11,
            ),
            78 => 
            array (
                'permission_id' => 27,
                'role_id' => 12,
            ),
            79 => 
            array (
                'permission_id' => 30,
                'role_id' => 11,
            ),
            80 => 
            array (
                'permission_id' => 30,
                'role_id' => 12,
            ),
            81 => 
            array (
                'permission_id' => 31,
                'role_id' => 11,
            ),
            82 => 
            array (
                'permission_id' => 31,
                'role_id' => 12,
            ),
            83 => 
            array (
                'permission_id' => 32,
                'role_id' => 11,
            ),
            84 => 
            array (
                'permission_id' => 32,
                'role_id' => 12,
            ),
            85 => 
            array (
                'permission_id' => 33,
                'role_id' => 4,
            ),
            86 => 
            array (
                'permission_id' => 33,
                'role_id' => 5,
            ),
            87 => 
            array (
                'permission_id' => 33,
                'role_id' => 6,
            ),
            88 => 
            array (
                'permission_id' => 33,
                'role_id' => 7,
            ),
            89 => 
            array (
                'permission_id' => 33,
                'role_id' => 11,
            ),
            90 => 
            array (
                'permission_id' => 33,
                'role_id' => 12,
            ),
            91 => 
            array (
                'permission_id' => 35,
                'role_id' => 11,
            ),
            92 => 
            array (
                'permission_id' => 35,
                'role_id' => 12,
            ),
            93 => 
            array (
                'permission_id' => 36,
                'role_id' => 11,
            ),
            94 => 
            array (
                'permission_id' => 36,
                'role_id' => 12,
            ),
            95 => 
            array (
                'permission_id' => 37,
                'role_id' => 11,
            ),
            96 => 
            array (
                'permission_id' => 37,
                'role_id' => 12,
            ),
            97 => 
            array (
                'permission_id' => 38,
                'role_id' => 4,
            ),
            98 => 
            array (
                'permission_id' => 38,
                'role_id' => 5,
            ),
            99 => 
            array (
                'permission_id' => 38,
                'role_id' => 6,
            ),
            100 => 
            array (
                'permission_id' => 38,
                'role_id' => 7,
            ),
            101 => 
            array (
                'permission_id' => 38,
                'role_id' => 11,
            ),
            102 => 
            array (
                'permission_id' => 38,
                'role_id' => 12,
            ),
            103 => 
            array (
                'permission_id' => 40,
                'role_id' => 11,
            ),
            104 => 
            array (
                'permission_id' => 40,
                'role_id' => 12,
            ),
            105 => 
            array (
                'permission_id' => 41,
                'role_id' => 11,
            ),
            106 => 
            array (
                'permission_id' => 41,
                'role_id' => 12,
            ),
            107 => 
            array (
                'permission_id' => 42,
                'role_id' => 11,
            ),
            108 => 
            array (
                'permission_id' => 42,
                'role_id' => 12,
            ),
            109 => 
            array (
                'permission_id' => 43,
                'role_id' => 4,
            ),
            110 => 
            array (
                'permission_id' => 43,
                'role_id' => 5,
            ),
            111 => 
            array (
                'permission_id' => 43,
                'role_id' => 6,
            ),
            112 => 
            array (
                'permission_id' => 43,
                'role_id' => 7,
            ),
            113 => 
            array (
                'permission_id' => 43,
                'role_id' => 11,
            ),
            114 => 
            array (
                'permission_id' => 43,
                'role_id' => 12,
            ),
            115 => 
            array (
                'permission_id' => 46,
                'role_id' => 11,
            ),
            116 => 
            array (
                'permission_id' => 46,
                'role_id' => 12,
            ),
            117 => 
            array (
                'permission_id' => 47,
                'role_id' => 4,
            ),
            118 => 
            array (
                'permission_id' => 47,
                'role_id' => 5,
            ),
            119 => 
            array (
                'permission_id' => 47,
                'role_id' => 6,
            ),
            120 => 
            array (
                'permission_id' => 47,
                'role_id' => 7,
            ),
            121 => 
            array (
                'permission_id' => 47,
                'role_id' => 11,
            ),
            122 => 
            array (
                'permission_id' => 47,
                'role_id' => 12,
            ),
            123 => 
            array (
                'permission_id' => 48,
                'role_id' => 4,
            ),
            124 => 
            array (
                'permission_id' => 48,
                'role_id' => 5,
            ),
            125 => 
            array (
                'permission_id' => 48,
                'role_id' => 6,
            ),
            126 => 
            array (
                'permission_id' => 48,
                'role_id' => 7,
            ),
            127 => 
            array (
                'permission_id' => 48,
                'role_id' => 11,
            ),
            128 => 
            array (
                'permission_id' => 48,
                'role_id' => 12,
            ),
            129 => 
            array (
                'permission_id' => 49,
                'role_id' => 11,
            ),
            130 => 
            array (
                'permission_id' => 49,
                'role_id' => 12,
            ),
            131 => 
            array (
                'permission_id' => 50,
                'role_id' => 11,
            ),
            132 => 
            array (
                'permission_id' => 50,
                'role_id' => 12,
            ),
            133 => 
            array (
                'permission_id' => 51,
                'role_id' => 11,
            ),
            134 => 
            array (
                'permission_id' => 51,
                'role_id' => 12,
            ),
            135 => 
            array (
                'permission_id' => 54,
                'role_id' => 11,
            ),
            136 => 
            array (
                'permission_id' => 54,
                'role_id' => 12,
            ),
            137 => 
            array (
                'permission_id' => 55,
                'role_id' => 4,
            ),
            138 => 
            array (
                'permission_id' => 55,
                'role_id' => 5,
            ),
            139 => 
            array (
                'permission_id' => 55,
                'role_id' => 6,
            ),
            140 => 
            array (
                'permission_id' => 55,
                'role_id' => 7,
            ),
            141 => 
            array (
                'permission_id' => 55,
                'role_id' => 11,
            ),
            142 => 
            array (
                'permission_id' => 55,
                'role_id' => 12,
            ),
            143 => 
            array (
                'permission_id' => 56,
                'role_id' => 11,
            ),
            144 => 
            array (
                'permission_id' => 56,
                'role_id' => 12,
            ),
            145 => 
            array (
                'permission_id' => 57,
                'role_id' => 11,
            ),
            146 => 
            array (
                'permission_id' => 57,
                'role_id' => 12,
            ),
            147 => 
            array (
                'permission_id' => 59,
                'role_id' => 4,
            ),
            148 => 
            array (
                'permission_id' => 59,
                'role_id' => 5,
            ),
            149 => 
            array (
                'permission_id' => 59,
                'role_id' => 6,
            ),
            150 => 
            array (
                'permission_id' => 59,
                'role_id' => 7,
            ),
            151 => 
            array (
                'permission_id' => 59,
                'role_id' => 11,
            ),
            152 => 
            array (
                'permission_id' => 59,
                'role_id' => 12,
            ),
            153 => 
            array (
                'permission_id' => 60,
                'role_id' => 11,
            ),
            154 => 
            array (
                'permission_id' => 60,
                'role_id' => 12,
            ),
            155 => 
            array (
                'permission_id' => 61,
                'role_id' => 4,
            ),
            156 => 
            array (
                'permission_id' => 61,
                'role_id' => 5,
            ),
            157 => 
            array (
                'permission_id' => 61,
                'role_id' => 6,
            ),
            158 => 
            array (
                'permission_id' => 61,
                'role_id' => 7,
            ),
            159 => 
            array (
                'permission_id' => 61,
                'role_id' => 11,
            ),
            160 => 
            array (
                'permission_id' => 61,
                'role_id' => 12,
            ),
            161 => 
            array (
                'permission_id' => 63,
                'role_id' => 4,
            ),
            162 => 
            array (
                'permission_id' => 63,
                'role_id' => 11,
            ),
            163 => 
            array (
                'permission_id' => 63,
                'role_id' => 12,
            ),
            164 => 
            array (
                'permission_id' => 64,
                'role_id' => 4,
            ),
            165 => 
            array (
                'permission_id' => 64,
                'role_id' => 11,
            ),
            166 => 
            array (
                'permission_id' => 64,
                'role_id' => 12,
            ),
            167 => 
            array (
                'permission_id' => 65,
                'role_id' => 4,
            ),
            168 => 
            array (
                'permission_id' => 65,
                'role_id' => 11,
            ),
            169 => 
            array (
                'permission_id' => 65,
                'role_id' => 12,
            ),
            170 => 
            array (
                'permission_id' => 66,
                'role_id' => 4,
            ),
            171 => 
            array (
                'permission_id' => 66,
                'role_id' => 5,
            ),
            172 => 
            array (
                'permission_id' => 66,
                'role_id' => 6,
            ),
            173 => 
            array (
                'permission_id' => 66,
                'role_id' => 7,
            ),
            174 => 
            array (
                'permission_id' => 66,
                'role_id' => 11,
            ),
            175 => 
            array (
                'permission_id' => 66,
                'role_id' => 12,
            ),
            176 => 
            array (
                'permission_id' => 67,
                'role_id' => 11,
            ),
            177 => 
            array (
                'permission_id' => 67,
                'role_id' => 12,
            ),
            178 => 
            array (
                'permission_id' => 68,
                'role_id' => 11,
            ),
            179 => 
            array (
                'permission_id' => 68,
                'role_id' => 12,
            ),
            180 => 
            array (
                'permission_id' => 69,
                'role_id' => 11,
            ),
            181 => 
            array (
                'permission_id' => 69,
                'role_id' => 12,
            ),
            182 => 
            array (
                'permission_id' => 70,
                'role_id' => 4,
            ),
            183 => 
            array (
                'permission_id' => 70,
                'role_id' => 5,
            ),
            184 => 
            array (
                'permission_id' => 70,
                'role_id' => 6,
            ),
            185 => 
            array (
                'permission_id' => 70,
                'role_id' => 7,
            ),
            186 => 
            array (
                'permission_id' => 70,
                'role_id' => 11,
            ),
            187 => 
            array (
                'permission_id' => 70,
                'role_id' => 12,
            ),
            188 => 
            array (
                'permission_id' => 71,
                'role_id' => 11,
            ),
            189 => 
            array (
                'permission_id' => 71,
                'role_id' => 12,
            ),
            190 => 
            array (
                'permission_id' => 72,
                'role_id' => 11,
            ),
            191 => 
            array (
                'permission_id' => 72,
                'role_id' => 12,
            ),
            192 => 
            array (
                'permission_id' => 73,
                'role_id' => 11,
            ),
            193 => 
            array (
                'permission_id' => 73,
                'role_id' => 12,
            ),
            194 => 
            array (
                'permission_id' => 74,
                'role_id' => 4,
            ),
            195 => 
            array (
                'permission_id' => 74,
                'role_id' => 5,
            ),
            196 => 
            array (
                'permission_id' => 74,
                'role_id' => 6,
            ),
            197 => 
            array (
                'permission_id' => 74,
                'role_id' => 7,
            ),
            198 => 
            array (
                'permission_id' => 74,
                'role_id' => 11,
            ),
            199 => 
            array (
                'permission_id' => 74,
                'role_id' => 12,
            ),
            200 => 
            array (
                'permission_id' => 75,
                'role_id' => 11,
            ),
            201 => 
            array (
                'permission_id' => 75,
                'role_id' => 12,
            ),
            202 => 
            array (
                'permission_id' => 76,
                'role_id' => 11,
            ),
            203 => 
            array (
                'permission_id' => 76,
                'role_id' => 12,
            ),
            204 => 
            array (
                'permission_id' => 77,
                'role_id' => 11,
            ),
            205 => 
            array (
                'permission_id' => 77,
                'role_id' => 12,
            ),
            206 => 
            array (
                'permission_id' => 78,
                'role_id' => 4,
            ),
            207 => 
            array (
                'permission_id' => 78,
                'role_id' => 5,
            ),
            208 => 
            array (
                'permission_id' => 78,
                'role_id' => 6,
            ),
            209 => 
            array (
                'permission_id' => 78,
                'role_id' => 7,
            ),
            210 => 
            array (
                'permission_id' => 78,
                'role_id' => 11,
            ),
            211 => 
            array (
                'permission_id' => 78,
                'role_id' => 12,
            ),
            212 => 
            array (
                'permission_id' => 79,
                'role_id' => 4,
            ),
            213 => 
            array (
                'permission_id' => 79,
                'role_id' => 11,
            ),
            214 => 
            array (
                'permission_id' => 79,
                'role_id' => 12,
            ),
            215 => 
            array (
                'permission_id' => 80,
                'role_id' => 4,
            ),
            216 => 
            array (
                'permission_id' => 80,
                'role_id' => 11,
            ),
            217 => 
            array (
                'permission_id' => 80,
                'role_id' => 12,
            ),
            218 => 
            array (
                'permission_id' => 81,
                'role_id' => 4,
            ),
            219 => 
            array (
                'permission_id' => 81,
                'role_id' => 11,
            ),
            220 => 
            array (
                'permission_id' => 81,
                'role_id' => 12,
            ),
            221 => 
            array (
                'permission_id' => 82,
                'role_id' => 4,
            ),
            222 => 
            array (
                'permission_id' => 82,
                'role_id' => 5,
            ),
            223 => 
            array (
                'permission_id' => 82,
                'role_id' => 6,
            ),
            224 => 
            array (
                'permission_id' => 82,
                'role_id' => 7,
            ),
            225 => 
            array (
                'permission_id' => 82,
                'role_id' => 11,
            ),
            226 => 
            array (
                'permission_id' => 82,
                'role_id' => 12,
            ),
            227 => 
            array (
                'permission_id' => 83,
                'role_id' => 4,
            ),
            228 => 
            array (
                'permission_id' => 83,
                'role_id' => 11,
            ),
            229 => 
            array (
                'permission_id' => 83,
                'role_id' => 12,
            ),
            230 => 
            array (
                'permission_id' => 84,
                'role_id' => 4,
            ),
            231 => 
            array (
                'permission_id' => 84,
                'role_id' => 11,
            ),
            232 => 
            array (
                'permission_id' => 84,
                'role_id' => 12,
            ),
            233 => 
            array (
                'permission_id' => 85,
                'role_id' => 4,
            ),
            234 => 
            array (
                'permission_id' => 85,
                'role_id' => 11,
            ),
            235 => 
            array (
                'permission_id' => 85,
                'role_id' => 12,
            ),
            236 => 
            array (
                'permission_id' => 86,
                'role_id' => 4,
            ),
            237 => 
            array (
                'permission_id' => 86,
                'role_id' => 5,
            ),
            238 => 
            array (
                'permission_id' => 86,
                'role_id' => 6,
            ),
            239 => 
            array (
                'permission_id' => 86,
                'role_id' => 7,
            ),
            240 => 
            array (
                'permission_id' => 86,
                'role_id' => 11,
            ),
            241 => 
            array (
                'permission_id' => 86,
                'role_id' => 12,
            ),
            242 => 
            array (
                'permission_id' => 87,
                'role_id' => 11,
            ),
            243 => 
            array (
                'permission_id' => 87,
                'role_id' => 12,
            ),
            244 => 
            array (
                'permission_id' => 88,
                'role_id' => 11,
            ),
            245 => 
            array (
                'permission_id' => 88,
                'role_id' => 12,
            ),
            246 => 
            array (
                'permission_id' => 89,
                'role_id' => 4,
            ),
            247 => 
            array (
                'permission_id' => 89,
                'role_id' => 5,
            ),
            248 => 
            array (
                'permission_id' => 89,
                'role_id' => 6,
            ),
            249 => 
            array (
                'permission_id' => 89,
                'role_id' => 7,
            ),
            250 => 
            array (
                'permission_id' => 89,
                'role_id' => 11,
            ),
            251 => 
            array (
                'permission_id' => 89,
                'role_id' => 12,
            ),
            252 => 
            array (
                'permission_id' => 90,
                'role_id' => 11,
            ),
            253 => 
            array (
                'permission_id' => 90,
                'role_id' => 12,
            ),
            254 => 
            array (
                'permission_id' => 91,
                'role_id' => 11,
            ),
            255 => 
            array (
                'permission_id' => 91,
                'role_id' => 12,
            ),
            256 => 
            array (
                'permission_id' => 92,
                'role_id' => 11,
            ),
            257 => 
            array (
                'permission_id' => 92,
                'role_id' => 12,
            ),
            258 => 
            array (
                'permission_id' => 93,
                'role_id' => 11,
            ),
            259 => 
            array (
                'permission_id' => 93,
                'role_id' => 12,
            ),
            260 => 
            array (
                'permission_id' => 94,
                'role_id' => 4,
            ),
            261 => 
            array (
                'permission_id' => 94,
                'role_id' => 5,
            ),
            262 => 
            array (
                'permission_id' => 94,
                'role_id' => 6,
            ),
            263 => 
            array (
                'permission_id' => 94,
                'role_id' => 7,
            ),
            264 => 
            array (
                'permission_id' => 94,
                'role_id' => 11,
            ),
            265 => 
            array (
                'permission_id' => 94,
                'role_id' => 12,
            ),
            266 => 
            array (
                'permission_id' => 95,
                'role_id' => 11,
            ),
            267 => 
            array (
                'permission_id' => 95,
                'role_id' => 12,
            ),
            268 => 
            array (
                'permission_id' => 96,
                'role_id' => 11,
            ),
            269 => 
            array (
                'permission_id' => 96,
                'role_id' => 12,
            ),
            270 => 
            array (
                'permission_id' => 97,
                'role_id' => 4,
            ),
            271 => 
            array (
                'permission_id' => 97,
                'role_id' => 5,
            ),
            272 => 
            array (
                'permission_id' => 97,
                'role_id' => 6,
            ),
            273 => 
            array (
                'permission_id' => 97,
                'role_id' => 7,
            ),
            274 => 
            array (
                'permission_id' => 97,
                'role_id' => 11,
            ),
            275 => 
            array (
                'permission_id' => 97,
                'role_id' => 12,
            ),
            276 => 
            array (
                'permission_id' => 99,
                'role_id' => 11,
            ),
            277 => 
            array (
                'permission_id' => 99,
                'role_id' => 12,
            ),
            278 => 
            array (
                'permission_id' => 100,
                'role_id' => 11,
            ),
            279 => 
            array (
                'permission_id' => 100,
                'role_id' => 12,
            ),
            280 => 
            array (
                'permission_id' => 101,
                'role_id' => 11,
            ),
            281 => 
            array (
                'permission_id' => 101,
                'role_id' => 12,
            ),
            282 => 
            array (
                'permission_id' => 102,
                'role_id' => 4,
            ),
            283 => 
            array (
                'permission_id' => 102,
                'role_id' => 5,
            ),
            284 => 
            array (
                'permission_id' => 102,
                'role_id' => 6,
            ),
            285 => 
            array (
                'permission_id' => 102,
                'role_id' => 7,
            ),
            286 => 
            array (
                'permission_id' => 102,
                'role_id' => 11,
            ),
            287 => 
            array (
                'permission_id' => 102,
                'role_id' => 12,
            ),
            288 => 
            array (
                'permission_id' => 103,
                'role_id' => 11,
            ),
            289 => 
            array (
                'permission_id' => 103,
                'role_id' => 12,
            ),
            290 => 
            array (
                'permission_id' => 107,
                'role_id' => 11,
            ),
            291 => 
            array (
                'permission_id' => 107,
                'role_id' => 12,
            ),
            292 => 
            array (
                'permission_id' => 108,
                'role_id' => 11,
            ),
            293 => 
            array (
                'permission_id' => 108,
                'role_id' => 12,
            ),
            294 => 
            array (
                'permission_id' => 109,
                'role_id' => 4,
            ),
            295 => 
            array (
                'permission_id' => 109,
                'role_id' => 5,
            ),
            296 => 
            array (
                'permission_id' => 109,
                'role_id' => 6,
            ),
            297 => 
            array (
                'permission_id' => 109,
                'role_id' => 7,
            ),
            298 => 
            array (
                'permission_id' => 109,
                'role_id' => 11,
            ),
            299 => 
            array (
                'permission_id' => 109,
                'role_id' => 12,
            ),
            300 => 
            array (
                'permission_id' => 110,
                'role_id' => 4,
            ),
            301 => 
            array (
                'permission_id' => 110,
                'role_id' => 5,
            ),
            302 => 
            array (
                'permission_id' => 110,
                'role_id' => 6,
            ),
            303 => 
            array (
                'permission_id' => 110,
                'role_id' => 7,
            ),
            304 => 
            array (
                'permission_id' => 110,
                'role_id' => 11,
            ),
            305 => 
            array (
                'permission_id' => 110,
                'role_id' => 12,
            ),
            306 => 
            array (
                'permission_id' => 135,
                'role_id' => 3,
            ),
            307 => 
            array (
                'permission_id' => 135,
                'role_id' => 4,
            ),
            308 => 
            array (
                'permission_id' => 135,
                'role_id' => 5,
            ),
            309 => 
            array (
                'permission_id' => 135,
                'role_id' => 6,
            ),
            310 => 
            array (
                'permission_id' => 135,
                'role_id' => 7,
            ),
            311 => 
            array (
                'permission_id' => 135,
                'role_id' => 11,
            ),
            312 => 
            array (
                'permission_id' => 135,
                'role_id' => 12,
            ),
            313 => 
            array (
                'permission_id' => 136,
                'role_id' => 3,
            ),
            314 => 
            array (
                'permission_id' => 136,
                'role_id' => 5,
            ),
            315 => 
            array (
                'permission_id' => 136,
                'role_id' => 6,
            ),
            316 => 
            array (
                'permission_id' => 136,
                'role_id' => 7,
            ),
            317 => 
            array (
                'permission_id' => 136,
                'role_id' => 11,
            ),
            318 => 
            array (
                'permission_id' => 136,
                'role_id' => 12,
            ),
            319 => 
            array (
                'permission_id' => 137,
                'role_id' => 4,
            ),
            320 => 
            array (
                'permission_id' => 137,
                'role_id' => 5,
            ),
            321 => 
            array (
                'permission_id' => 137,
                'role_id' => 6,
            ),
            322 => 
            array (
                'permission_id' => 137,
                'role_id' => 7,
            ),
            323 => 
            array (
                'permission_id' => 137,
                'role_id' => 11,
            ),
            324 => 
            array (
                'permission_id' => 137,
                'role_id' => 12,
            ),
            325 => 
            array (
                'permission_id' => 139,
                'role_id' => 11,
            ),
            326 => 
            array (
                'permission_id' => 139,
                'role_id' => 12,
            ),
            327 => 
            array (
                'permission_id' => 140,
                'role_id' => 11,
            ),
            328 => 
            array (
                'permission_id' => 140,
                'role_id' => 12,
            ),
            329 => 
            array (
                'permission_id' => 141,
                'role_id' => 11,
            ),
            330 => 
            array (
                'permission_id' => 141,
                'role_id' => 12,
            ),
            331 => 
            array (
                'permission_id' => 143,
                'role_id' => 11,
            ),
            332 => 
            array (
                'permission_id' => 143,
                'role_id' => 12,
            ),
            333 => 
            array (
                'permission_id' => 145,
                'role_id' => 4,
            ),
            334 => 
            array (
                'permission_id' => 145,
                'role_id' => 11,
            ),
            335 => 
            array (
                'permission_id' => 145,
                'role_id' => 12,
            ),
            336 => 
            array (
                'permission_id' => 146,
                'role_id' => 11,
            ),
            337 => 
            array (
                'permission_id' => 146,
                'role_id' => 12,
            ),
            338 => 
            array (
                'permission_id' => 147,
                'role_id' => 4,
            ),
            339 => 
            array (
                'permission_id' => 147,
                'role_id' => 5,
            ),
            340 => 
            array (
                'permission_id' => 147,
                'role_id' => 6,
            ),
            341 => 
            array (
                'permission_id' => 147,
                'role_id' => 7,
            ),
            342 => 
            array (
                'permission_id' => 147,
                'role_id' => 11,
            ),
            343 => 
            array (
                'permission_id' => 147,
                'role_id' => 12,
            ),
            344 => 
            array (
                'permission_id' => 148,
                'role_id' => 4,
            ),
            345 => 
            array (
                'permission_id' => 148,
                'role_id' => 5,
            ),
            346 => 
            array (
                'permission_id' => 148,
                'role_id' => 7,
            ),
            347 => 
            array (
                'permission_id' => 148,
                'role_id' => 11,
            ),
            348 => 
            array (
                'permission_id' => 148,
                'role_id' => 12,
            ),
            349 => 
            array (
                'permission_id' => 149,
                'role_id' => 4,
            ),
            350 => 
            array (
                'permission_id' => 149,
                'role_id' => 5,
            ),
            351 => 
            array (
                'permission_id' => 149,
                'role_id' => 7,
            ),
            352 => 
            array (
                'permission_id' => 149,
                'role_id' => 11,
            ),
            353 => 
            array (
                'permission_id' => 149,
                'role_id' => 12,
            ),
            354 => 
            array (
                'permission_id' => 150,
                'role_id' => 4,
            ),
            355 => 
            array (
                'permission_id' => 150,
                'role_id' => 5,
            ),
            356 => 
            array (
                'permission_id' => 150,
                'role_id' => 7,
            ),
            357 => 
            array (
                'permission_id' => 150,
                'role_id' => 11,
            ),
            358 => 
            array (
                'permission_id' => 150,
                'role_id' => 12,
            ),
            359 => 
            array (
                'permission_id' => 151,
                'role_id' => 4,
            ),
            360 => 
            array (
                'permission_id' => 151,
                'role_id' => 5,
            ),
            361 => 
            array (
                'permission_id' => 151,
                'role_id' => 6,
            ),
            362 => 
            array (
                'permission_id' => 151,
                'role_id' => 7,
            ),
            363 => 
            array (
                'permission_id' => 151,
                'role_id' => 11,
            ),
            364 => 
            array (
                'permission_id' => 151,
                'role_id' => 12,
            ),
            365 => 
            array (
                'permission_id' => 152,
                'role_id' => 4,
            ),
            366 => 
            array (
                'permission_id' => 152,
                'role_id' => 11,
            ),
            367 => 
            array (
                'permission_id' => 152,
                'role_id' => 12,
            ),
            368 => 
            array (
                'permission_id' => 153,
                'role_id' => 4,
            ),
            369 => 
            array (
                'permission_id' => 153,
                'role_id' => 11,
            ),
            370 => 
            array (
                'permission_id' => 153,
                'role_id' => 12,
            ),
            371 => 
            array (
                'permission_id' => 154,
                'role_id' => 4,
            ),
            372 => 
            array (
                'permission_id' => 154,
                'role_id' => 11,
            ),
            373 => 
            array (
                'permission_id' => 154,
                'role_id' => 12,
            ),
            374 => 
            array (
                'permission_id' => 155,
                'role_id' => 7,
            ),
            375 => 
            array (
                'permission_id' => 155,
                'role_id' => 11,
            ),
            376 => 
            array (
                'permission_id' => 155,
                'role_id' => 12,
            ),
            377 => 
            array (
                'permission_id' => 156,
                'role_id' => 11,
            ),
            378 => 
            array (
                'permission_id' => 156,
                'role_id' => 12,
            ),
            379 => 
            array (
                'permission_id' => 157,
                'role_id' => 11,
            ),
            380 => 
            array (
                'permission_id' => 157,
                'role_id' => 12,
            ),
            381 => 
            array (
                'permission_id' => 158,
                'role_id' => 11,
            ),
            382 => 
            array (
                'permission_id' => 158,
                'role_id' => 12,
            ),
            383 => 
            array (
                'permission_id' => 159,
                'role_id' => 11,
            ),
            384 => 
            array (
                'permission_id' => 159,
                'role_id' => 12,
            ),
            385 => 
            array (
                'permission_id' => 160,
                'role_id' => 11,
            ),
            386 => 
            array (
                'permission_id' => 160,
                'role_id' => 12,
            ),
            387 => 
            array (
                'permission_id' => 161,
                'role_id' => 11,
            ),
            388 => 
            array (
                'permission_id' => 161,
                'role_id' => 12,
            ),
            389 => 
            array (
                'permission_id' => 162,
                'role_id' => 11,
            ),
            390 => 
            array (
                'permission_id' => 162,
                'role_id' => 12,
            ),
            391 => 
            array (
                'permission_id' => 163,
                'role_id' => 11,
            ),
            392 => 
            array (
                'permission_id' => 163,
                'role_id' => 12,
            ),
            393 => 
            array (
                'permission_id' => 164,
                'role_id' => 11,
            ),
            394 => 
            array (
                'permission_id' => 164,
                'role_id' => 12,
            ),
            395 => 
            array (
                'permission_id' => 165,
                'role_id' => 11,
            ),
            396 => 
            array (
                'permission_id' => 165,
                'role_id' => 12,
            ),
            397 => 
            array (
                'permission_id' => 166,
                'role_id' => 11,
            ),
            398 => 
            array (
                'permission_id' => 166,
                'role_id' => 12,
            ),
            399 => 
            array (
                'permission_id' => 167,
                'role_id' => 11,
            ),
            400 => 
            array (
                'permission_id' => 167,
                'role_id' => 12,
            ),
            401 => 
            array (
                'permission_id' => 168,
                'role_id' => 3,
            ),
            402 => 
            array (
                'permission_id' => 168,
                'role_id' => 11,
            ),
            403 => 
            array (
                'permission_id' => 168,
                'role_id' => 12,
            ),
        ));
        
        
    }
}