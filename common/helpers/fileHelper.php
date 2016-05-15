<?php


class FileHelper
{

    // public function to read a file as a string
	public function readFile($filePath)
	{

		$data = file_get_contents($filePath);
		return $data;

	}


    // public function to write a data to a file. It overwrites the existing data in the file.
	public function writeFile($filePath, $data)
	{
		$currentFile = fopen($filePath, "w");
		echo fwrite($currentFile, $data);
		fclose($currentFile);

		return "Successfully wrote to a File.";
	}



    // public function to append data to a file. It doesn't overwrite the existing data in the file.
	public function appendToAFile($filePath, $data)
	{

		$currentFile = fopen($filePath, "a") or die("Unable to open file!");
		fwrite($currentFile, "\n". $data);
		fclose($currentFile);

		return "Successfully appended to a File.";

	}



}