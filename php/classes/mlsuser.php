<?php

/**
 *
 * A user profile for the comments of MLSsoccer.com
 *
 * This is the class for a basic profile for any user of MLSsoccer.com's comment section
 * It contains the basic details such as the user's username and avatar
 *
 * @author Bradley Brown <tall.white.ninja@gmail.com>
 */
class MlsUser {
	/**
	 *  id for this user; this is the primary key
	 * @var int $userId
	 */
	private $userId;
	/**
	 *  the photographic avatar of the user, as a URL
	 * @var string $avatar
	 */
	private $avatar;
	/**
	 *  the username of this particular user
	 * @var string $username
	 */
	private $username;

	/*
	 * accessor method for userId
	 *
	 * @return mixed value of user Id
	 */
	public function getUserId(){
		return($this->userId);
	}

	/*
	 * mutator method for user Id
	 *
	 * @param mixed $newUserId value of user ID
	 * @throws InvalidArgumentException if $newUserId is not an integer
	 * @throws RangeException if $newUserId is not positive
	 */
	public function setUserId($newUserId){
		//base case: if the new user ID is null, this is a new user, and there is no mySQL ID assigned as of yet
		if($newUserId === null){
			$this->userId = null;
			return;
		}

		//verify that the ID is a valid integer
		$newUserId = filter_var($newUserId, FILTER_VALIDATE_INT);
		if($newUserId === false){
			throw(new InvalidArgumentException("User ID is not a valid integer."));
		}

		//now, verify that the ID number is positive
		if($newUserId <= 0){
			throw(new RangeException("User ID is not positive"));
		}

		//convert the value to integer, and store
		$this->userId = intval($newUserId);
	}

	/*
	 * accessor method for avatar
	 *
	 * @return string value of avatar URL
	 */
	public function getAvatar(){
		return($this->avatar);
	}

	/*
	 * mutator method for avatar
	 *
	 * @param string $newAvatar new value of avatar, as a URL
	 * @throws InvalidArgumentException if $newAvatar is not in URL form, or insecure
	 * @throws RangeException if $newAvatar is > 256 characters
	 */
	public function setAvatar($newAvatar){
		//verify that the new avatar URL is secure
		$newAvatar = trim($newAvatar);
		$newAvatar = filter_var($newAvatar, FILTER_SANITIZE_URL);
		//reject and throw exception if one of the above failed
		//avatar is not required, so allow the empty case
		if($newAvatar === false){
			throw(new InvalidArgumentException("Avatar URL is insecure"));
		}
		//verify that the new avatar value will fit in the database, throw exception if it does not
		if(strlen($newAvatar) > 256){
			throw(new RangeException("Avatar URL is too large"));
		}
		//store the new avatar
		$this->avatar = $newAvatar;
	}

	/*
	 * accessor method for username
	 *
	 * @return string value of username
	 */
	public function getUsername(){
		return($this->username);
	}

	/*
	 * mutator method for username
	 *
	 * @param string $newUsername new value of username
	 * @throws InvalidArgumentException if $newUsername is not a string or insecure
	 * @throws RangeException if $newUsername is longer than 64 characters
	 */
	public function setUsername($newUsername){
		//verify security of the new username
		$newUsername = trim($newUsername);
		$newUsername = filter_var($newUsername, FILTER_SANITIZE_STRING);
		//if an empty string is found, or if the input failed one of the above, reject and throw exception
		if(empty($newUsername === true)){
			throw(new InvalidArgumentException("Username is either empty or insecure"));
		}
		//verify that the username will fit in the database, throw exception if it does not
		if(strlen($newUsername) > 64){
			throw(new RangeException("Username is too large"));
		}
		//store the new username
		$this->username = $newUsername;
	}
}