<?php

namespace App\Core;

use PhpOffice\PhpSpreadsheet\Reader\Xls;

class Excel {

    public function import($antioxydant,$moisturizing, $barriere, $untreatedSkinAntioxydant, $untreatedSkinMoisturizing, $untreatedSkinBarriere)
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

        if($moisturizing === 1) {
            foreach ($products as $key => $product) {
                $sumMoisturizingT0Product = 0;
                $sumMoisturizingT1Product = 0;
                $sumMoisturizingT2Product = 0;
                $sumMoisturizingT3Product = 0;
                $countT0 = 0;
                $countT1 = 0;
                $countT2 = 0;
                $countT3 = 0;
                foreach ($datas as $data) {
                    if ($data[0] === $product) {
                        if($data[2]==='2') {
                            if ($data[3] === '2') {
                                if ($data[4] === '1') {
                                    $sumMoisturizingT0Product = $data[5] + $sumMoisturizingT0Product;
                                    $countT0++;
                                }
                                if ($data[4] === '2') {
                                    $sumMoisturizingT1Product = $data[5] + $sumMoisturizingT1Product;
                                    $countT1++;
                                }
                                if ($data[4] === '3') {
                                    $sumMoisturizingT2Product = $data[5] + $sumMoisturizingT2Product;
                                    $countT2++;
                                }
                                if ($data[4] === '4') {
                                    $sumMoisturizingT3Product = $data[5] + $sumMoisturizingT3Product;
                                    $countT3++;
                                }
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

                    'product'.$key.'SumT2' => $sumMoisturizingT2Product,
                    'countT2'=> $countT2,
                    'moyenneT2'=> $sumMoisturizingT2Product/$countT2,

                    'product'.$key.'SumT3' => $sumMoisturizingT3Product,
                    'countT3'=> $countT3,
                    'moyenneT3'=> $sumMoisturizingT3Product/$countT3,

                    'description'=> 'Moyenne VITC & SKC de T0 à T1 avec pour critères Moisturizing sur une peau traitée'
                );
            }
        }

        if($antioxydant === 1){
            foreach ($products as $key => $product) {
                $sumAntioxydantT0Product = 0;
                $sumAntioxydantT1Product = 0;
                $sumAntioxydantT2Product = 0;
                $sumAntioxydantT3Product = 0;
                $countT0 = 0;
                $countT1 = 0;
                $countT2 = 0;
                $countT3 = 0;
                foreach ($datas as $data) {
                    if ($data[0] === $product) {
                        if($data[2]==='2') {
                            if ($data[3] === '1') {
                                if ($data[4] === '1') {
                                    $sumAntioxydantT0Product = $data[5] + $sumAntioxydantT0Product;
                                    $countT0++;
                                }
                                if ($data[4] === '2') {
                                    $sumAntioxydantT1Product = $data[5] + $sumAntioxydantT1Product;
                                    $countT1++;
                                }
                                if ($data[4] === '3') {
                                    $sumAntioxydantT2Product = $data[5] + $sumAntioxydantT2Product;
                                    $countT2++;
                                }
                                if ($data[4] === '4') {
                                    $sumAntioxydantT3Product = $data[5] + $sumAntioxydantT3Product;
                                    $countT3++;
                                }
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

                    'product'.$key.'SumT2' => $sumAntioxydantT2Product,
                    'countT2'=> $countT2,
                    'moyenneT2'=> $sumAntioxydantT2Product/$countT2,

                    'product'.$key.'SumT3' => $sumAntioxydantT3Product,
                    'countT3'=> $countT3,
                    'moyenneT3'=> $sumAntioxydantT3Product/$countT3,

                    'description'=> 'Moyenne VITC & SKC de T0 à T1 avec pour critères Antioxidant sur une peau traitée'
                );
            }
        }

        if($barriere === 1){
            foreach ($products as $key => $product) {
                $sumBarriereT0Product = 0;
                $sumBarriereT1Product = 0;
                $sumBarriereT2Product = 0;
                $sumBarriereT3Product = 0;
                $countT0 = 0;
                $countT1 = 0;
                $countT2 = 0;
                $countT3 = 0;
                foreach ($datas as $data) {
                    if ($data[0] === $product) {
                        if($data[2]==='2') {
                            if ($data[3] === '3') {
                                if ($data[4] === '1') {
                                    $sumBarriereT0Product = $data[5] + $sumBarriereT0Product;
                                    $countT0++;
                                }
                                if ($data[4] === '2') {
                                    $sumBarriereT1Product = $data[5] + $sumBarriereT1Product;
                                    $countT1++;
                                }
                                if ($data[4] === '3') {
                                    $sumBarriereT2Product = $data[5] + $sumBarriereT2Product;
                                    $countT2++;
                                }
                                if ($data[4] === '4') {
                                    $sumBarriereT3Product = $data[5] + $sumBarriereT3Product;
                                    $countT3++;
                                }
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

                    'product'.$key.'SumT2' => $sumBarriereT2Product,
                    'countT2'=> $countT2,
                    'moyenneT2'=> $sumBarriereT2Product/$countT2,

                    'product'.$key.'SumT3' => $sumBarriereT3Product,
                    'countT3'=> $countT3,
                    'moyenneT3'=> $sumBarriereT3Product/$countT3,

                    'description'=> 'Moyenne VITC & SKC de T0 à T1 avec pour critères Barrière sur une peau traité'
                );
            }
        }

        if($untreatedSkinMoisturizing === 1) {
            foreach ($products as $key => $product) {
                $sumMoisturizingUntreatedSkinT0Product = 0;
                $sumMoisturizingUntreatedSkinT1Product = 0;
                $sumMoisturizingUntreatedSkinT2Product = 0;
                $sumMoisturizingUntreatedSkinT3Product = 0;
                $countT0 = 0;
                $countT1 = 0;
                $countT2 = 0;
                $countT3 = 0;
                foreach ($datas as $data) {
                    if ($data[0] === $product) {
                        if($data[2]==='1') {
                            if ($data[3] === '2') {
                                if ($data[4] === '1') {
                                    $sumMoisturizingUntreatedSkinT0Product = $data[5] + $sumMoisturizingUntreatedSkinT0Product;
                                    $countT0++;
                                }
                                if ($data[4] === '2') {
                                    $sumMoisturizingUntreatedSkinT1Product = $data[5] + $sumMoisturizingUntreatedSkinT1Product;
                                    $countT1++;
                                }
                                if ($data[4] === '3') {
                                    $sumMoisturizingUntreatedSkinT2Product = $data[5] + $sumMoisturizingUntreatedSkinT2Product;
                                    $countT2++;
                                }
                                if ($data[4] === '4') {
                                    $sumMoisturizingUntreatedSkinT3Product = $data[5] + $sumMoisturizingUntreatedSkinT3Product;
                                    $countT3++;
                                }
                            }
                        }
                    }
                }
                $dataMoisturizingUntreatedSkin[$key] = array(
                    'product'.$key.'SumT0' => $sumMoisturizingUntreatedSkinT0Product,
                    'countT0' =>$countT0,
                    'moyenneT0'=>$sumMoisturizingUntreatedSkinT0Product/$countT0,

                    'product'.$key.'SumT1' => $sumMoisturizingUntreatedSkinT1Product,
                    'countT1' =>$countT1,
                    'moyenneT1'=>$sumMoisturizingUntreatedSkinT1Product/$countT1,

                    'product'.$key.'SumT2' => $sumMoisturizingUntreatedSkinT2Product,
                    'countT2' =>$countT2,
                    'moyenneT2'=>$sumMoisturizingUntreatedSkinT2Product/$countT2,

                    'product'.$key.'SumT3' => $sumMoisturizingUntreatedSkinT3Product,
                    'countT3' =>$countT3,
                    'moyenneT3'=>$sumMoisturizingUntreatedSkinT3Product/$countT3,

                    'description'=> 'Moyenne VITC & SKC de T0 à T1 avec pour critères Moisturizing sur une peau non traitée'
                );
            }
        }

        if($untreatedSkinAntioxydant === 1) {
            foreach ($products as $key => $product) {
                $sumAntioxydantUntreatedSkinT0Product = 0;
                $sumAntioxydantUntreatedSkinT1Product = 0;
                $sumAntioxydantUntreatedSkinT2Product = 0;
                $sumAntioxydantUntreatedSkinT3Product = 0;
                $countT0 = 0;
                $countT1 = 0;
                $countT2 = 0;
                $countT3 = 0;
                foreach ($datas as $data) {
                    if ($data[0] === $product) {
                        if($data[2]==='1') {
                            if ($data[3] === '1') {
                                if ($data[4] === '1') {
                                    $sumAntioxydantUntreatedSkinT0Product = $data[5] + $sumAntioxydantUntreatedSkinT0Product;
                                    $countT0++;
                                }
                                if ($data[4] === '2') {
                                    $sumAntioxydantUntreatedSkinT1Product = $data[5] + $sumAntioxydantUntreatedSkinT1Product;
                                    $countT1++;
                                }
                                if ($data[4] === '3') {
                                    $sumAntioxydantUntreatedSkinT2Product = $data[5] + $sumAntioxydantUntreatedSkinT2Product;
                                    $countT2++;
                                }
                                if ($data[4] === '4') {
                                    $sumAntioxydantUntreatedSkinT3Product = $data[5] + $sumAntioxydantUntreatedSkinT3Product;
                                    $countT3++;
                                }
                            }
                        }
                    }
                }
                $dataAntioxydantUntreatedSkin[$key] = array(
                    'product'.$key.'SumT0' => $sumAntioxydantUntreatedSkinT0Product,
                    'countT0' =>$countT0,
                    'moyenneT0'=>$sumAntioxydantUntreatedSkinT0Product/$countT0,

                    'product'.$key.'SumT1' => $sumAntioxydantUntreatedSkinT1Product,
                    'countT1' =>$countT1,
                    'moyenneT1'=>$sumAntioxydantUntreatedSkinT1Product/$countT1,

                    'product'.$key.'SumT2' => $sumAntioxydantUntreatedSkinT2Product,
                    'countT2' =>$countT2,
                    'moyenneT2'=>$sumAntioxydantUntreatedSkinT2Product/$countT2,

                    'product'.$key.'SumT3' => $sumAntioxydantUntreatedSkinT3Product,
                    'countT3' =>$countT3,
                    'moyenneT3'=>$sumAntioxydantUntreatedSkinT3Product/$countT3,

                    'description'=> 'Moyenne VITC & SKC de T0 à T1 avec pour critères Antioxydant sur une peau non traitée'
                );
            }
        }

        if($untreatedSkinBarriere === 1) {
            foreach ($products as $key => $product) {
                $sumBarriereUntreatedSkinT0Product = 0;
                $sumBarriereUntreatedSkinT1Product = 0;
                $sumBarriereUntreatedSkinT2Product = 0;
                $sumBarriereUntreatedSkinT3Product = 0;
                $countT0 = 0;
                $countT1 = 0;
                $countT2 = 0;
                $countT3 = 0;
                foreach ($datas as $data) {
                    if ($data[0] === $product) {
                        if($data[2]==='1') {
                            if ($data[3] === '3') {
                                if ($data[4] === '1') {
                                    $sumBarriereUntreatedSkinT0Product = $data[5] + $sumBarriereUntreatedSkinT0Product;
                                    $countT0++;
                                }
                                if ($data[4] === '2') {
                                    $sumBarriereUntreatedSkinT1Product = $data[5] + $sumBarriereUntreatedSkinT1Product;
                                    $countT1++;
                                }
                                if ($data[4] === '3') {
                                    $sumBarriereUntreatedSkinT2Product = $data[5] + $sumBarriereUntreatedSkinT2Product;
                                    $countT2++;
                                }
                                if ($data[4] === '4') {
                                    $sumBarriereUntreatedSkinT3Product = $data[5] + $sumBarriereUntreatedSkinT3Product;
                                    $countT3++;
                                }
                            }
                        }
                    }
                }
                $dataBarriereUntreatedSkin[$key] = array(
                    'product'.$key.'SumT0' => $sumBarriereUntreatedSkinT0Product,
                    'countT0' =>$countT0,
                    'moyenneT0'=>$sumBarriereUntreatedSkinT0Product/$countT0,

                    'product'.$key.'SumT1' => $sumBarriereUntreatedSkinT1Product,
                    'countT1' =>$countT1,
                    'moyenneT1'=>$sumBarriereUntreatedSkinT1Product/$countT1,

                    'product'.$key.'SumT2' => $sumBarriereUntreatedSkinT2Product,
                    'countT2' =>$countT2,
                    'moyenneT'=>$sumBarriereUntreatedSkinT2Product/$countT2,

                    'product'.$key.'SumT3' => $sumBarriereUntreatedSkinT3Product,
                    'countT3' =>$countT3,
                    'moyenneT3'=>$sumBarriereUntreatedSkinT3Product/$countT3,

                    'description'=> 'Moyenne VITC & SKC de T0 à T1 avec pour critères Barriere sur une peau non traitée'
                );
            }
        }

        $datas = array(
            'moisturizing' => $dataMoisturizing,
            'antioxydant'=> $dataAntioxydant,
            'barriere' => $dataBarriere,
            'untreatedSkinMoisturizing'=>$dataMoisturizingUntreatedSkin,
            'untreatedSkinAntioxydant'=>$dataAntioxydantUntreatedSkin,
            'untreatedSkinBarriere'=>$dataBarriereUntreatedSkin,
        );
        return $datas;
    }

}