<?php
// Composerオートローダを読み込む
require_once '../vendor/autoload.php';

// レスポンス
$res = [
    'status' => 'OK',
    'errorCodeList' => [],
];

try{
    /** @var Validate $validate */
    $validate = new Validate();
    /** @var Mail $mail */
    $mail = new Mail();

    // 入力データの格納
    $inputData = $_POST['input'];
    // 問い合わせチェック
    $validate->checkContact($inputData);
    // エラー内容取得
    $errorCodeList = $validate->getErrorCodeList();

    // エラーがある場合、問い合わせTOPへリダイレクト
    if(!empty($errorCodeList)){
        $res['errorCodeList'] = $errorCodeList;
        throw new Exception('validate error');
    }

    // 問い合わせ内容を格納
    $body  = "tokenskyJPに、以下のお問い合わせがありました。\n\n";
    $body .= "■お問い合わせ種別：{$inputData['contact_type']}\n";
    $body .= "■出展社名（和名）：{$inputData['store_name_ja']}\n";
    $body .= "■出展社名（カナ）：{$inputData['store_name_kana']}\n";
    $body .= "■出展社名（英語）：{$inputData['store_name_en']}\n";
    $body .= "■会社名：{$inputData['company']}\n";
    $body .= "■会社名（カナ）：{$inputData['company_kana']}\n";
    $body .= "■氏名：{$inputData['name']}\n";
    $body .= "■氏名（カナ）：{$inputData['name_kana']}\n";
    $body .= "■メールアドレス：{$inputData['email']}\n";
    $body .= "■郵便番号：{$inputData['postal_code']}\n";
    $body .= "■住所：{$inputData['address']}\n";
    $body .= "■TEL：{$inputData['tel']}\n";
    $body .= "■お問い合わせ内容：\n";
    $body .= "-----------------------------\n";
    $body .= $inputData['content']."\n";
    $body .= "-----------------------------\n";

    // メール送信
    $mail->sendMail('y_furusawa@asobimo.com', $inputData['email'], '[tokenskyJP]お問い合わせ', $body);

} catch (Exception $e) {
    $res['status'] = 'NG';
}

echo json_encode($res);
exit;