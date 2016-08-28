<?php
require_once __DIR__."/../header.php";

/**
 * Class User stores user specific information
 */
class User{
	/** @var  string $username is the username */
	private $username;
	/** @var  string $email is the email */
	private $email;
	/** @var  string $fname is the first name */
	private $fname;
	/** @var  string $lname is the last name */
	private $lname;
	/** @var  int $gender is the gender as an integer */
	private $gender;
	/** @var  string $webID is the webID */
	private $webID;
	/** @var  string $passwd is the hashed password */
	private $passwd;
	/** @var  int $userID is the unique identifier assigned by the database */
	private $userID;
	/** @var  string $feedText is the full xml text of the feed */
	private $feedText;
	/** @var  int $feedLength is the maximum number of items in the feed */
	private $feedLength;
	/** @var  array $feedDetails is an associative array containing the details used to make the feed */
	private $feedDetails;

	/**
	 * User constructor.
	 */
	public function __construct(){
		$this->feedDetails = ["title"=>"YouTube to Podcast",
			"description"=>"Converts YouTube videos into a podcast feed.",
			"icon"=>"https://upload.wikimedia.org/wikipedia/commons/thumb/d/d9/Rss-feed.svg/256px-Rss-feed.svg.png",
			"itunesAuthor"=>"Michael Dombrowski"];
	}

	/**
	 * Checks if plaintext password when hashed, matches the hashed password stored in this User
	 *
	 * @param string $passwd The password to check against the password stored in the database
	 * @return bool
	 */
	public function passwdCorrect($passwd){
		return hash("SHA512", $passwd.$this->username) == $this->getPasswd();
	}

	/**
	 * Gets user ID
	 * @return mixed
	 */
	public function getUserID(){
		return $this->userID;
	}

	/**
	 * Sets user ID
	 * @param mixed $userID
	 */
	public function setUserID($userID){
		$this->userID = $userID;
	}

	/**
	 * Gets username in lowercase
	 * @return mixed
	 */
	public function getUsername(){
		return strtolower($this->username);
	}

	/**
	 * Sets username in lowercase
	 * @param mixed $username
	 */
	public function setUsername($username){
		$username = strtolower($username);
		$this->username = $username;
	}

	/**
	 * Gets email in lowercase
	 * @return mixed
	 */
	public function getEmail(){
		return strtolower($this->email);
	}

	/**
	 * Sets email in lower case
	 * @param mixed $email
	 */
	public function setEmail($email){
		$email = strtolower($email);
		$this->email = $email;
	}

	/**
	 * Gets first name
	 * @return mixed
	 */
	public function getFname(){
		return $this->fname;
	}

	/**
	 * Sets first name
	 * @param mixed $fname
	 */
	public function setFname($fname){
		$this->fname = $fname;
	}

	/**
	 * Gets last name
	 * @return mixed
	 */
	public function getLname(){
		return $this->lname;
	}

	/**
	 * Sets last name
	 * @param mixed $lname
	 */
	public function setLname($lname){
		$this->lname = $lname;
	}

	/**
	 * Gets gender as integer, or if not set, returns 1 (Male)
	 * @return int
	 */
	public function getGender(){
		if($this->gender == ""){
			return 1;
		}
		return $this->gender;
	}

	/**
	 * Sets gender
	 * @param int $gender
	 */
	public function setGender($gender){
		$this->gender = $gender;
	}

	/**
	 * Gets webID
	 * @return mixed
	 */
	public function getWebID(){
		return $this->webID;
	}

	/**
	 * Sets webID
	 * @param string $webID
	 */
	public function setWebID($webID){
		$this->webID = $webID;
	}

	/**
	 * Gets hashed password
	 * @return mixed
	 */
	public function getPasswd(){
		return $this->passwd;
	}

	/**
	 * Sets hashed password using plaintext password and username
	 *
	 * @param string $passwd
	 * @throws \Exception Username must be set before setting the password because the password is stored as a hash of the plaintext password and the username
	 */
	public function setPasswd($passwd){
		if($this->username != ""){
			$passwd = hash("SHA512", $passwd.$this->username);
			$this->passwd = $passwd;
		}else{
			throw new Exception("Username needs to be set before setting password!");
		}
	}

	/**
	 * Used to set the hashed password from the database.
	 *
	 * @param string $passwd Hashed password from database
	 */
	public function setPasswdDB($passwd){
		$this->passwd = $passwd;
	}

	/**
	 * Gets feed text
	 * @return string
	 */
	public function getFeedText(){
		return $this->feedText;
	}

	/**
	 * Sets feed text
	 * @param string $feedText
	 */
	public function setFeedText($feedText){
		$this->feedText = $feedText;
	}

	/**
	 * Gets feed length
	 * @return int
	 */
	public function getFeedLength(){
		return $this->feedLength;
	}

	/**
	 * Sets feed length
	 * @param int $feedLength
	 */
	public function setFeedLength($feedLength){
		$this->feedLength = $feedLength;
	}

	/**
	 * Gets the feed detail array
	 * @return array
	 */
	public function getFeedDetails(){
		return $this->feedDetails;
	}

	/**
	 * Sets the feed detail array
	 * @param array $feedDetails
	 */
	public function setFeedDetails($feedDetails){
		$this->feedDetails = $feedDetails;
	}

}
