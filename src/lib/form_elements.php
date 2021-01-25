<?php
require_once "autoload.php";

function MakeSelect( $fkey, $value, $sql )
{
    $select = "<select id=$fkey name=$fkey value=$value>";
    $select .= "<option value='0'></option>";

    $data = GetData($sql);
var_dump($data);
    foreach ( $data as $row )
    {
        if ( $row[0] == $value ) $selected = " selected ";
        else $selected = "";

        $select .= "<option $selected value=" . $row[0] . ">" . $row[1] . "</option>";
    }

    $select .= "</select>";

    return $select;
}

function MakeDatalist( $value, $sql )
{
    $datalist = "<input type='text' list=$value />";
    $datalist = "<datalist id=$value>";

    $data = GetData($sql);

    foreach ( $data as $row )
    {
//        $datalist .= '<option value="' . $row[0] . '">' . $row[1] . '</option>';
        $datalist .= '<option data-value="' . $row[0] . '" value="' . $row[1] . '">';
    }

    $datalist .= "</datalist>";

    return $datalist;
}

function MakeCheckbox( )
{

}