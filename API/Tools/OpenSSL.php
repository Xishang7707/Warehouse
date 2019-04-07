<?php
namespace Tools;

class OpenSSL
{

    /**
     * 配置
     * digest_alg string default_md 摘要算法或签名哈希算法，通常是 openssl_get_md_methods() 之一。
     * x509_extensions string x509_extensions 选择在创建x509证书时应该使用哪些扩展
     * req_extensions string req_extensions 创建CSR时，选择使用哪个扩展
     * private_key_bits integer default_bits 指定应该使用多少位来生成私钥
     * private_key_type integer none 选择在创建CSR时应该使用哪些扩展。可选值有 OPENSSL_KEYTYPE_DSA, OPENSSL_KEYTYPE_DH, OPENSSL_KEYTYPE_RSA 或 OPENSSL_KEYTYPE_EC. 默认值是 OPENSSL_KEYTYPE_RSA.
     * encrypt_key boolean encrypt_key 是否应该对导出的密钥（带有密码短语）进行加密?
     * encrypt_key_cipher integer none cipher constants常量之一。
     * curve_name string none 要求PHP7.1+, openssl_get_curve_names()之一。
     * config string N/A 自定义 openssl.conf 文件的路径。
     *
     * @var array
     */
    private static $config = [
        'digest_alg' => 'sha512',
        'private_key_bits' => 1024,
        'config' => 'E:/wamp64/bin/apache/apache2.4.35/conf/openssl.cnf'
    ];

    /**
     * 创建私钥和公钥
     *
     * @param array $config
     * @return boolean|string|mixed[]
     */
    public static function getKey(array $config = NULL)
    {
        if (isset($config))
            $conf = array_merge(self::$config, $config);
        else
            $conf = self::$config;
        $res = openssl_pkey_new($conf);
        if (! $res)
            return FALSE;

        if (! openssl_pkey_export($res, $prvKey, null, $conf))
            return FALSE;

        $arr = [
            'pubKey' => openssl_pkey_get_details($res)['key'],
            'prvKey' => $prvKey
        ];
        return $arr;
    }
	
    /**
     * 通过私钥解密数据
     *
     * @param string $data
     * @param string $key
     * @return boolean|string
     */
    public static function prv_decrypt(string $data, string $key)
    {
        if (! openssl_private_decrypt($data, $dec, $key))
            return FALSE;
        return $dec;
    }

    /**
     * 通过公钥加密数据
     *
     * @param string $data
     * @param string $key
     * @return boolean|string
     */
    public static function pub_encrypt(string $data, string $key)
    {
        if (! openssl_public_encrypt($data, $enc, $key))
            return FALSE;
        return $enc;
    }
}