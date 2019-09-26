<?php

class SynoFileHostingLostfilm
{
    const COOKIE_FILE = '/tmp/lostfilm.cookie';

    private $Url;
    private $Username;
    private $Password;
    private $HostInfo;

    public function __construct($Url, $Username, $Password, $HostInfo)
    {
        $this->Url = $Url;
        $this->Username = $Username;
        $this->Password = $Password;
        $this->HostInfo = $HostInfo;
    }

    //This function returns download url.
    public function GetDownloadInfo()
    {
        $ret = $this->Verify(false);
        if ($ret == LOGIN_FAIL) {
            return false;
        }

        $domain = parse_url($this->Url, PHP_URL_HOST);
        $this->createCookies($domain);

        return [
            DOWNLOAD_URL => $this->Url,
            DOWNLOAD_COOKIE => self::COOKIE_FILE
        ];
    }

    //This function verifies and returns account type.
    public function Verify($ClearCookie)
    {
        $ret = LOGIN_FAIL;
        if (!empty($this->Username) && !empty($this->Password)) {
            $ret = USER_IS_FREE;
        }
        if ($ClearCookie && file_exists(self::COOKIE_FILE)) {
            unlink(self::COOKIE_FILE);
        }

        return $ret;
    }

    private function createCookies($domain)
    {
        $cookies = [
            'uid' => $this->Username,
            'usess' => $this->Password
        ];

        $lines = [];
        foreach ($cookies as $name => $value) {
            $lines[] = implode("\t", [
                $domain,                //Domain
                'TRUE',                 //Flag
                '/',                    //Path
                'FALSE',                //Secure
                time() + 3600,          //Expiration
                $name,                  //Name
                $value                  //Value
            ]);
        }
        $lines[] = ''; //Empty line

        file_put_contents(self::COOKIE_FILE, implode("\n", $lines));
    }
}
