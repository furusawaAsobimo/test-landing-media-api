<?php

class Validate
{
	// メールアドレスバリデーションパターン
	const POSIX_PATTERN_MAIL_ADDRESS = "/^[a-zA-Z0-9\-\._]+@[a-zA-Z0-9\-\._]+$/";

	// 必須項目
    public $requiredItems = [
        'tokensky' => [
            'contact_type','store_name_ja','store_name_kana','company','company_kana',
            'name','name_kana','email','email_confirm','postal_code','address','tel'
        ]
    ];

	// エラーコード一覧
	public $errorCodeList = array();

	/**
	 * エラーコード一覧の取得
	 *
	 * @return array エラーメッセージコード
	 */
	public function getErrorCodeList()
	{
		return $this->errorCodeList;
	}

	/**
	 * メールアドレスバリデート
	 *
	 * @param string $mailAddress メールアドレス
	 */
	public function checkMailAddress($mailAddress)
	{
		$mailAddress = trim($mailAddress);

		// 入力なし
		if($mailAddress === ""){
			$this->errorCodeList['email'] = 'empty';
		}

		// フォーマットチェック
		if(!preg_match(self::POSIX_PATTERN_MAIL_ADDRESS, $mailAddress)){
			$this->errorCodeList['email'] = 'invalid';
		}
	}

	/**
	 * 問い合わせバリデート
	 *
	 * @param array $inputData 入力データ
	 * @param string $requireItemsKey 必須項目キー
     * @return string エラーメッセージコード
	 */
	public function checkContact($inputData, $requireItemsKey = null)
	{
		// 必須項目キー設定がある場合
	    if(!empty($requireItemsKey)){
            // 必須項目チェック
            foreach($this->requiredItems[$requireItemsKey] as $key => $name){
                if(!isset($inputData[$name]) || empty($inputData[$name])){
                    $this->errorCodeList[$name] = 'empty';
                }
            }
        }

		// メールアドレスチェック
		$this->checkMailAddress($inputData['email']);
	    // メール確認があり、メールと異なる場合
        if(isset($inputData['email_confirm']) && $inputData['email'] != $inputData['email_confirm']){
            $this->errorCodeList['email_confirm'] = 'confirm';
        }
	}
}