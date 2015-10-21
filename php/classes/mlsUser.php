<?php

/**
 *
 * A user profile for the comments of MLSsoccer.com
 *
 * This is the basic profile for any user of MLSsoccer.com's comment section
 * It contains the basic public details viewable to other commentors
 *
 * @author Bradley Brown <tall.white.ninja@gmail.com>
 */
class mlsUser {
	/**
	 *  id for this user; this is the primary key
	 * @var int $userId
	 */
	private $userId;
	/**
	 *  the username of this particular user
	 * @var string $username
	 */
	private $username;
	/**
	 *  the photographic avatar of the user, in URL form
	 * @var string $avatar
	 */
	private $avatar;

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
	 * @param mixed $newUserId value of user ID
	 * @throws InvalidArgumentException if $newUserId is not an integer
	 * @throws RangeException if $newUserId is not positive
	 */
	public function setUserId($newUserId){
		//base case: it is a new user, and there is no mySQL ID assigned as of yet
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

		//convert the value to integer, and stroe
		$this->userId = $newUserId;
	}

	/*
	 * accessor method for username
	 *
	 * @return string value of user Id
	 */
	public function getUsername(){
		return($this->username);
	}

	/*
	 * accessor method for avatar
	 *
	 * @return string value of avatar
	 */
	public function getAvatar(){
		return($this->avatar);
	}


}