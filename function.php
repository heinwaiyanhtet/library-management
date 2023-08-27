<?php

function book_url()
{
	return "asset/img/books/";
};

function fileNameWithoutExtension($fileName)
{
   return pathinfo($fileName, PATHINFO_FILENAME);
}

function currentDate()
{
   return date('Y-m-d H:i:s');

}
?>