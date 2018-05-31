<?php

class MessageRestFull {

    CONST TYPE_OK = 'Ok';
    CONST TYPE_ERROR = 'Error';

    protected $Res;
    protected $Mens;
    protected $tecnical;
    protected $arDatos;
    protected $arExtraData;

    public function __construct($arDatos, $type, $sMessage = '', $sTecnical = '', $arExtraData = array()) {

        $this->arDatos = $arDatos;
        $this->tecnical = $sTecnical;
        $this->Res=$type;
        $this->arExtraData = $arExtraData;
        $this->Mens=$sMessage;
        $this->tecnical =$sTecnical;

    }

    public function toArray(){

        $arData = array(
            "success" => array(
                "Res"      => $this->Res,
                "Mens"     => $this->Mens,
                "tecnical" => $this->tecnical
            ),
            "Datos"     => $this->arDatos,
            "ExtraData" => $this->arExtraData
        );
        return $arData;
    }



}