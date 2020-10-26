<?php

class Lang 
{   
    private static $_Lang   = DEFAULT_LANG;
    private static $_LangID = NULL;
    private static $_Data   = NULL;
    
    public static function SetLang($Lang, $LangID)
    {   
        self::$_Lang   = $Lang;
        self::$_LangID = $LangID;
    }

    public static function GetLang()
    {   
        return self::$_Lang;
    }

    public static function GetLangID()
    {   
        return self::$_LangID;
    }
    
    public static function SetData()
    {
        if(is_null(self::$_Data))
        {
            self::$_Data = json_decode(file_get_contents('langs/' . self::$_Lang . '.json'), true);
        }
    }

    public static function Get($Key)
    {
        self::SetData();

        //print_r(self::$_Data);
        if(is_array($Key))
        {
            switch(count($Key))
            {
                case 2:
                return isset(self::$_Data[$Key[0]][$Key[1]])? self::$_Data[$Key[0]][$Key[1]] : '!lang';
                break;
                
                case 3:
                return isset(self::$_Data[$Key[0]][$Key[1]][$Key[2]])? self::$_Data[$Key[0]][$Key[1]][$Key[2]] : '!lang';
                break;
            }
        }

        return isset(self::$_Data[$Key])? self::$_Data[$Key] : '!lang';
    }
}