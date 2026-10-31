<?php

class ProductController extends Controller {
    public function index($req) {
        $products = [
            [
                'title' => 'ระบบ ERP',
                'description' => 'จัดการงานยากๆ ขององค์กรให้เรียบง่ายและราบลื่น',
                'ai_feature' => 'ใช้ AI ร่วมดำเนินการ ทำให้ใช้งานได้ง่ายขึ้น',
                'status' => 'อยู่ระหว่างพัฒนา พบกันเร็วๆ นี้',
                'icon_type' => 'erp'
            ],
            [
                'title' => 'ระบบ AI Assistant',
                'description' => 'ผู้ช่วยส่วนตัวบนหน้าจอ Laptop และ PC',
                'ai_feature' => 'พบประสบการณ์การใช้ AI แบบง่าย เป็นผู้ช่วยที่คุณสามารถเรียกใช้ได้อย่างดี',
                'status' => 'อยู่ระหว่างพัฒนา พบกันเร็วๆ นี้',
                'icon_type' => 'assistant'
            ],
            [
                'title' => 'Novel AI Translator',
                'description' => 'การแปลภาษาเน้นสำหรับผู้อ่านนิยาย',
                'ai_feature' => 'สามารถแปลได้อย่างเสถียรและราบลื่น ขึ้นอยู่กับส่วนสมอง ที่เลือกใช้',
                'status' => 'อยู่ระหว่างพัฒนา พบกันเร็วๆ นี้',
                'icon_type' => 'translator'
            ]
        ];

        return $this->view('products_page', [
            'title' => 'ผลิตภัณฑ์ของเรา | t-lek tech.',
            'products' => $products
        ]);
    }
}
