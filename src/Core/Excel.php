<?php

namespace App\Core;

use PhpOffice\PhpSpreadsheet\Reader\Xls;

class Excel {

    public function import($antioxydant,$moisturizing, $barriere)
    {

        $dataMoisturizing = array();
        $dataAntioxydant = array();
        $dataBarriere = array();

        $reader = new xls();

        $spreadsheet = $reader->load('excel/DatasHackaton_2022_08_03.xls');

        $worksheet = $spreadsheet->getsheet(0);

        $products = array();
        $rowinit = 1;
        $collinit = 3;
        $row = $rowinit;

        do {
            $row = $row + 1;
            $cell = $worksheet->getcellbycolumnandrow($collinit, $row);
        } while ($cell != "");

        for ($j = $rowinit + 1; $j <= ($row - 1); $j++) {
            $data = "";
            $cell = $worksheet->getcellbycolumnandrow($collinit, $j);
            if ($data == '') {
                $data .= $cell;
            } else {
                $data .= "," . $cell;
            }
            $products[] = $data;
        }

        $worksheet = $spreadsheet->getsheet(1);

        $datas = array();
        $rowinit = 1;
        $collinit = 1;
        $row = $rowinit;

        do{
            $row = $row +1;
            $cell = $worksheet->getcellbycolumnandrow($collinit,$row);
        }while($cell != "");

        for($j= $rowinit+1; $j <= ($row-1); $j ++){
            $data = "";
            for($i = $collinit;  $i<=6; $i ++ ){
                $cell = $worksheet->getcellbycolumnandrow($i,$j);
                if($data == ''){
                    $data .= $cell;
                }else {
                    $data .= ",".$cell;
                }
            }
            $tab = explode(",",$data);
            $datas[] = $tab;
        }

        $dataMoisturizing= array();
        if($moisturizing === 1) {
            foreach ($products as $key => $product) {
                $sumMoisturizingT0Product = 0;
                $sumMoisturizingT1Product = 0;
                $countT0 = 0;
                $countT1 = 0;
                foreach ($datas as $data) {
                    if ($data[0] === $product) {
                        if($data[3]==='2') {
                            if ($data[4] === '1') {
                                $sumMoisturizingT0Product = $data[5] + $sumMoisturizingT0Product;
                                $countT0++;
                            }
                            if ($data[4] === '2') {
                                $sumMoisturizingT1Product = $data[5] + $sumMoisturizingT1Product;
                                $countT1++;
                            }
                        }
                    }
                }
                $dataMoisturizing[$key] = array(
                    'product'.$key.'SumT0' => $sumMoisturizingT0Product,
                    'countT0' =>$countT0,
                    'moyenneT0'=>$sumMoisturizingT0Product/$countT0,
                    'product'.$key.'SumT1' => $sumMoisturizingT1Product,
                    'countT1' =>$countT1,
                    'moyenneT1'=>$sumMoisturizingT1Product/$countT1,
                    'description'=> 'Moyenne VITC & SKC de T0 à T1 avec pour critères Moisturizing '
                );
            }
        }

        if($antioxydant === 1){
            foreach ($products as $key => $product) {
                $sumAntioxydantT0Product = 0;
                $sumAntioxydantT1Product = 0;
                $countT0 = 0;
                $countT1 = 0;
                foreach ($datas as $data) {
                    if ($data[0] === $product) {
                        if($data[3]==='1') {
                            if ($data[4] === '1') {
                                $sumAntioxydantT0Product = $data[5] + $sumAntioxydantT0Product;
                                $countT0++;
                            }
                            if ($data[4] === '2') {
                                $sumAntioxydantT1Product = $data[5] + $sumAntioxydantT1Product;
                                $countT1++;
                            }
                        }
                    }
                }
                $dataAntioxydant[$key] = array(
                    'product'.$key.'SumT0' => $sumAntioxydantT0Product,
                    'countT0' =>$countT0,
                    'moyenneT0'=>$sumAntioxydantT0Product/$countT0,
                    'product'.$key.'SumT1' => $sumAntioxydantT1Product,
                    'countT1' =>$countT1,
                    'moyenneT1'=>$sumAntioxydantT1Product/$countT1,
                    'description'=> 'Moyenne VITC & SKC de T0 à T1 avec pour critères Antioxidant '
                );
            }
        }

        if($barriere === 1){
            foreach ($products as $key => $product) {
                $sumBarriereT0Product = 0;
                $sumBarriereT1Product = 0;
                $countT0 = 0;
                $countT1 = 0;
                foreach ($datas as $data) {
                    if ($data[0] === $product) {
                        if($data[3]==='3') {
                            if ($data[4] === '1') {
                                $sumBarriereT0Product = $data[5] + $sumBarriereT0Product;
                                $countT0++;
                            }
                            if ($data[4] === '2') {
                                $sumBarriereT1Product = $data[5] + $sumBarriereT1Product;
                                $countT1++;
                            }
                        }
                    }
                }
                $dataBarriere[$key] = array(
                    'product'.$key.'SumT0' => $sumBarriereT0Product,
                    'countT0' =>$countT0,
                    'moyenneT0'=>$sumBarriereT0Product/$countT0,
                    'product'.$key.'SumT1' => $sumBarriereT1Product,
                    'countT1' =>$countT1,
                    'moyenneT1'=>$sumBarriereT1Product/$countT1,
                    'description'=> 'Moyenne VITC & SKC de T0 à T1 avec pour critères Barrière '
                );
            }
        }

        $datas = array(
            'moisturizing' => $dataMoisturizing,
            'antioxydant'=> $dataAntioxydant,
            'barriere' => $dataBarriere,
        );
        return $datas;
    }

}