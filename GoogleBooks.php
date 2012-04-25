<?php

require_once("./GoogleBooksConf.php");
require_once("./google-api-php-client/src/apiClient.php");
require_once("./google-api-php-client/src/contrib/apiBooksService.php");
require_once("./Book.php");
//Service Account Client ID
//GB_API_CLIENT_ID
//Service Account Name
//GB_API_SERVICE_ACCOUNT_EMAIL
//Key File
//GB_API_KEY_FILE

//add Function to add book to google bookself
//takes a book object as a param
class GoogleBooks
{

	public function add($pBookObject)
	{
		$client = new apiClient();
		$client->setApplicationName(GB_API_APP_NAME);

		session_start();
		//Set cached access token
		if (isset($_SESSION['gb_api_token']))
		{
			$client->setAccessToken($_SESSION['gb_api_token']);
		}

		//Load key in PKCS 12 format
		$gb_key = file_get_contents(GB_API_KEY_FILE);
		$client->setAssertionCredentials(new apiAssertionCredentials(GB_API_SERVICE_ACCOUNT_EMAIL, array('https://www.googleapis.com/auth/books'), $gb_key));
		$client->setClientId(GB_API_CLIENT_ID);

		$service = new apiBooksService($client);
		$mylib = $service->mylibrary_bookshelves;
		//Book code goes here
		#$shelf2 = $mylib->get(GB_API_BOOKSHELF_UID, array());
		#echo $shelf2->getVolumeCount();
		#echo $mylib->addVolume(2, 'HFjLm2BauZ8C', array());
		#if(!$mylib->addVolume(GB_API_BOOKSHELF_UID, $pBookObject->getVolumeID, array()))
		$mylib->addVolume(GB_API_BOOKSHELF_UID, $pBookObject->getVolumeID(), array());

		//Update access token
		if($client->getAccessToken())
		{
			$_SESSION['gb_api_token'] = $client->getAccessToken();
		}

		return 1;
	}

	public function search($pISBN)
	{
		$client = new apiClient();
		$client->setApplicationName(GB_API_APP_NAME);

		session_start();
		//Set cached access token
		if (isset($_SESSION['gb_api_token']))
		{
			$client->setAccessToken($_SESSION['gb_api_token']);
		}

		//Load key in PKCS 12 format
		$gb_key = file_get_contents(GB_API_KEY_FILE);
		$client->setAssertionCredentials(new apiAssertionCredentials(GB_API_SERVICE_ACCOUNT_EMAIL, array('https://www.googleapis.com/auth/books'), $gb_key));
		$client->setClientId(GB_API_CLIENT_ID);

		$service = new apiBooksService($client);
		//Get volume service object
		$googleVols = $service->volumes;
		
		$optParams = array();
		$optParams['printType'] = "books";
		$q = "isbn:".$pISBN;

		//get volumes object
		$results = $googleVols->listVolumes($q, $optParams);

		if($results->getTotalItems() == 0)
		{
			return 0;
		}

		if($results->getTotalItems() > 1)
		{
			return 0;
		}
		//Get volume array
		$volumes = $results->getItems();

		$theBook = new Book();
		foreach($volumes as $volume)
		{
			//get volume id
			$theBook->setVolumeID($volume->getId());
			//get VolumeVolInfo object
			$volumeInfo = $volume->getVolumeInfo();
			//need author publisher, isbn
			$theBook->setName($volumeInfo->getTitle());
			$theBook->setNumAvailable(1);
			$theBook->setPCount($volumeInfo->getPageCount());
			$theBook->setDescription($volumeInfo->getDescription());
			$theBook->setQuantity(1);
			//get ISBN info?
			$volumeIndInfo = $volumeInfo->getIndustryIdentifiers();
			$isbn10 = -1;
			$isbn13 = -1;
			foreach($volumeIndInfo as $indInfo)
			{
				if($indInfo->getType == "ISBN_13")
				{
					$isbn13 = $indInfo->getIdentifier();
				}
				if($indInfo->getType == "ISBN_10")
				{
					$isbn10 = $indInfo->getIdentifier();
				}
			}
			if($isbn13 != -1)
			{
				$theBook->setISBN($isbn13);
			}
			else
			{
				$theBook->setISBN($isbn10);
			}
		}
		#$mylib = $service->mylibrary_bookshelves;
		//Book code goes here
		#$shelf2 = $mylib->get(GB_API_BOOKSHELF_UID, array());
		#echo $shelf2->getVolumeCount();
		#echo $mylib->addVolume(2, 'HFjLm2BauZ8C', array());
		#if(!$mylib->addVolume(GB_API_BOOKSHELF_UID, $pBookObject->getVolumeID, array()))
		#$mylib->addVolume(GB_API_BOOKSHELF_UID, $pBookObject->getVolumeID(), array());

		//Update access token
		if($client->getAccessToken())
		{
			$_SESSION['gb_api_token'] = $client->getAccessToken();
		}

		return $theBook;

	}

	public function find($pISBN, $pAuthor = array(), $pTitle, $pKeywords = array())
	{

	}

	public function remove($pBookObject)
	{

		$client = new apiClient();
		$client->setApplicationName(GB_API_APP_NAME);

		session_start();
		//Set cached access token
		if (isset($_SESSION['gb_api_token']))
		{
			$client->setAccessToken($_SESSION['gb_api_token']);
		}

		//Load key in PKCS 12 format
		$gb_key = file_get_contents(GB_API_KEY_FILE);
		$client->setAssertionCredentials(new apiAssertionCredentials(GB_API_SERVICE_ACCOUNT_EMAIL, array('https://www.googleapis.com/auth/books'), $gb_key));
		$client->setClientId(GB_API_CLIENT_ID);

		$service = new apiBooksService($client);
		$mylib = $service->mylibrary_bookshelves;
		//Book code goes here
		//	$shelf2 = $mylib->get(GB_API_BOOKSHELF_UID, array());
		//	echo $shelf2->getVolumeCount();
		#echo $mylib->addVolume(2, 'HFjLm2BauZ8C', array());
		#if(!$mylib->addVolume(GB_API_BOOKSHELF_UID, $pBookObject->getVolumeID, array()))
		$mylib->removeVolume(GB_API_BOOKSHELF_UID, $pBookObject->getVolumeID(), array());

		//Update access token
		if($client->getAccessToken())
		{
			$_SESSION['gb_api_token'] = $client->getAccessToken();
		}

		return 1;
	}
}
//add_google_book(NULL);
//remove_google_book(NULL);
$gbObj = new GoogleBooks();
$gbObj->search(9781593270650);
?>Hello World
