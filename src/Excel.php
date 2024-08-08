<?php

namespace Smark\Smark;

use CodexWorld\PhpXlsxGenerator;

class Excel
{
    public static function downloadExcel($excelArray, $source)
    {
        require 'excel/PhpXlsxGenerator.php';
        // Initialize an empty array to store associative arrays
        $sourceArray = [];
        // Convert each user to an associative array
        foreach ($source as $s) {
            $sourceArray[] = $s->toArray(); // Convert the model to an associative array
        }
        foreach ($sourceArray as $key => $value) {
            array_push($excelArray, $value);
        }
        $xlsx = PhpXlsxGenerator::fromArray($excelArray);
        $filename = uniqid('', true).'.'.'xlsx';
        return $xlsx->downloadAs($filename);
    }

    public static function downloadExcelAs($filename, $excelArray, $source)
    {
        require 'excel/PhpXlsxGenerator.php';
        // Initialize an empty array to store associative arrays
        $sourceArray = [];
        // Convert each user to an associative array
        foreach ($source as $s) {
            $sourceArray[] = $s->toArray(); // Convert the model to an associative array
        }
        foreach ($sourceArray as $key => $value) {
            array_push($excelArray, $value);
        }
        $xlsx = PhpXlsxGenerator::fromArray($excelArray);
        return $xlsx->downloadAs($filename.'.'.'xlsx');
    }

    public static function _downloadExcel($excelArray, $source)
    {
        require 'excel/PhpXlsxGenerator.php';

        foreach ($source as $key => $value) {
            array_push($excelArray, $value);
        }
        $xlsx = PhpXlsxGenerator::fromArray($excelArray);
        $filename = uniqid('', true).'.'.'xlsx';
        return $xlsx->downloadAs($filename);
    }

    public static function _downloadExcelAs($filename, $excelArray, $source)
    {
        require 'excel/PhpXlsxGenerator.php';
        foreach ($source as $key => $value) {
            array_push($excelArray, $value);
        }
        $xlsx = PhpXlsxGenerator::fromArray($excelArray);
        return $xlsx->downloadAs($filename.'.'.'xlsx');
    }
}
