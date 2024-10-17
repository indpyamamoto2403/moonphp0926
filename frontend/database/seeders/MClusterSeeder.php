<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class MClusterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $clusters = [
            ['industry_name' => '建設・不動産（総合建設業）'],
            ['industry_name' => '建設・不動産（設備・内外装関連）'],
            ['industry_name' => '建設・不動産（土木・造園）'],
            ['industry_name' => '建設・不動産（建設設計業）'],
            ['industry_name' => '建設・不動産（不動産業）'],
            ['industry_name' => '建設・不動産（その他）'],
            ['industry_name' => '製造（非鉄金属および金属製品）'],
            ['industry_name' => '製造（ゴム・プラスチック・化学製品）'],
            ['industry_name' => '製造（各種機械器具）'],
            ['industry_name' => '製造（電気機器・電子部品・制御盤等）'],
            ['industry_name' => '製造（金属）'],
            ['industry_name' => '製造（紙製品）'],
            ['industry_name' => '製造（印刷および印刷関連）'],
            ['industry_name' => '製造（飲食料品）'],
            ['industry_name' => '製造（医療・繊維・革・服飾雑貨品）'],
            ['industry_name' => '製造（家具・雑貨・生活用品）'],
            ['industry_name' => '製造（医薬・化粧品）'],
            ['industry_name' => '製造（その他）'],
            ['industry_name' => '商社・卸売（非鉄金属および金属製品）'],
            ['industry_name' => '商社・卸売（ゴム・プラスチック・化学製品）'],
            ['industry_name' => '商社・卸売（各種機械器具）'],
            ['industry_name' => '商社・卸売（紙製品）'],
            ['industry_name' => '商社・卸売（飲食料品）'],
            ['industry_name' => '商社・卸売（医療・繊維・革・服飾雑貨品）'],
            ['industry_name' => '商社・卸売（家具・雑貨・生活用品）'],
            ['industry_name' => '商社・卸売（医薬・化粧品）'],
            ['industry_name' => '商社・卸売（その他）'],
            ['industry_name' => '情報・通信・広告（WEB制作）'],
            ['industry_name' => '情報・通信・広告（IT・システム開発）'],
            ['industry_name' => '情報・通信・広告（ソフトウェア・アプリケーション）'],
            ['industry_name' => '情報・通信・広告（広告・映像等企画制作）'],
            ['industry_name' => '情報・通信・広告（その他）'],
            ['industry_name' => '専門・技術サービス（人材派遣・職業紹介）'],
            ['industry_name' => '専門・技術サービス（運輸・倉庫）'],
            ['industry_name' => '専門・技術サービス（警備・設備メンテナンス）'],
            ['industry_name' => '専門・技術サービス（自動車整備）'],
            ['industry_name' => '専門・技術サービス（廃棄物処理）'],
            ['industry_name' => '専門・技術サービス（機械修理）'],
            ['industry_name' => '専門・技術サービス（その他）'],
            ['industry_name' => 'コンサルティング（税務・会計）'],
            ['industry_name' => 'コンサルティング（法務・知的財産）'],
            ['industry_name' => 'コンサルティング（人事・労務）'],
            ['industry_name' => 'コンサルティング（その他）'],
            ['industry_name' => '小売り（各種機械器具）'],
            ['industry_name' => '小売り（飲食料品）'],
            ['industry_name' => '小売り（医療・遷移・革・服飾雑貨品）'],
            ['industry_name' => '小売り（家具・雑貨・生活用品）'],
            ['industry_name' => '小売り（医薬・化粧品）'],
            ['industry_name' => '小売り（その他）'],
            ['industry_name' => '生活サービス（飲食）'],
            ['industry_name' => '生活サービス（旅行・宿泊・娯楽）'],
            ['industry_name' => '生活サービス（理美容・浴場）'],
            ['industry_name' => '生活サービス（その他）'],
            ['industry_name' => '医療・福祉・教育（医療）'],
            ['industry_name' => '医療・福祉・教育（福祉・介護）'],
            ['industry_name' => '医療・福祉・教育（教育・学習支援）'],
            ['industry_name' => '医療・福祉・教育（その他）'],
            ['industry_name' => '金融・保険（保険）'],
            ['industry_name' => '金融・保険（その他）'],
            ['industry_name' => 'その他（上記に属さない事業）'],
        ];

        DB::table('m_cluster')->insert($clusters);
    }
}
