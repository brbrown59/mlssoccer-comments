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
	 **/
	private $userId;
	/**
	 *  the photographic avatar of the user, as a URL
	 * @var string $avatar
	 **/
	private $avatar;
	/**
	 *  the username of this particular user
	 * @var string $username
	 **/
	private $username;

	/**
	 * constructor for the MlsUser class
	 *
	 * @param mixed $newUserId value of user ID
	 * @param string $newAvatar new value of avatar, as a URL
	 * @param string $newUsername new value of username
	 * @throws InvalidArgumentException if data types are not valid
	 * @throws RangeException if data values are out of bounds (strings that are too long, or negative integers)
	 * @throws Exception if some other exception is thrown
	 **/
	public function __construct($newUserId, $newAvatar, $newUsername){
		try{
			//call the class's mutators with the given parameters
			$this->setUserId($newUserId);
			$this->setAvatar($newAvatar);
			$this->setUsername($newUsername);
			//rethrow any caught exceptions to the caller, including the generic exception
		} catch(InvalidArgumentException $invalidArgument){
			throw(new InvalidArgumentException($invalidArgument->getMessage(), 0, $invalidArgument));
		} catch(RangeException $range){
			throw(new RangeException($range->getMessage(), 0, $range));
		} catch(Exception $exception){
			throw(new Exception($exception->getMessage(), 0, $exception));
		}
	}
	/**
	 * accessor method for userId
	 *
	 * @return mixed value of user Id
	 **/
	public function getUserId(){
		return($this->userId);
	}

	/**
	 * mutator method for user Id
	 *
	 * @param mixed $newUserId value of user ID
	 * @throws InvalidArgumentException if $newUserId is not an integer
	 * @throws RangeException if $newUserId is not positive
	 **/
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

	/**
	 * accessor method for avatar
	 *
	 * @return string value of avatar URL
	 **/
	public function getAvatar(){
		return($this->avatar);
	}

	/**
	 * mutator method for avatar
	 *
	 * @param string $newAvatar new value of avatar, as a URL
	 * @throws InvalidArgumentException if $newAvatar is not in URL form, or insecure
	 * @throws RangeException if $newAvatar is > 256 characters
	 **/
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

	/**
	 * accessor method for username
	 *
	 * @return string value of username
	 **/
	public function getUsername(){
		return($this->username);
	}

	/**
	 * mutator method for username
	 *
	 * @param string $newUsername new value of username
	 * @throws InvalidArgumentException if $newUsername is not a string or insecure
	 * @throws RangeException if $newUsername is longer than 64 characters
	 **/
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

	/**
	 * inserts this user into the database
	 *
	 * @param PDO $pdo PDO connection object
	 * @throws PDOException if mySQL-related error occurs
	 **/
	public function insert(PDO $pdo){
		//if the user is already in the database, don't add it
		if ($this->userId !== null){
			throw(new PDOException("Not a new user"));
		}
		//create query template
		$query = "INSERT INTO mlsUser(userId, username, avatar) VALUES(:userId, :username, :avatar)";
		$statement = $pdo->prepare($query);

		//feed values into the template
		$parameters = array("userId" => $this->userId, "username" => $this->username, "avatar" => $this->avatar);
		$statement->execute($parameters);

		//retrieve the user's primary key as assigned by mySQL
		$this->userId = intval($pdo->lastInsertId());
	}

	/**
	 * deletes a user from the database
	 *
	 * @param PDO $pdo PDO connection object
	 * @throws PDOException if mySQL-related error occurs
	 **/
	public function delete(PDO $pdo){
		//don't delete a user that doesn't exist; check for a null userID
		if($this->userId === null){
			throw(new PDOException("Cannot delete a user that doesn't exist"));
		}

		//create query template
		$query = "DELETE FROM mlsUser WHERE userId = :userId";
		$statement = $pdo->prepare($query);

		//feed values into the template
		$parameters = array("userId" => $this->userId);
		$statement->execute($parameters);
	}

	/**
	 * updates this user in mySQL
	 *
	 * @param PDO $pdo PDO connection object
	 * @throws PDOException if mySQL-related error occurs
	 **/
	public function update(PDO $pdo){
		//check for null user ID: can't update user that doesn't exist
		if($this->userId === null){
			throw(new PDOException("Cannot update a user that does not exist"));
		}

		//create the query template
		$query = "UPDATE mlsUser SET username = :username, avatar = :avatar WHERE userId = :userId";
		$statement = $pdo->prepare($query);

		//feed values into the template
		$parameters = array("username" => $this->username, "avatar" => $this->avatar);
		$statement->execute($parameters);
	}

	/**
	 * retrieves a user from the database based on their username
	 *
	 * @param PDO $pdo PDO connection object
	 * @param string $username user name to search for
	 * @returns SplFixedArray all users found with this name
	 * @throws PDOException when mySQL-related errors occur
	 **/
	public static function getUserbyUsername(PDO $pdo, $username){
		//sanitize the input before searching
		$username = trim($username);
		$username = filter_var($username, FILTER_SANITIZE_STRING);
		if(empty($username === true)) {
			throw(new PDOException("Username is invalid"));
		}

		//create query template
		$query = "SELECT userId, username, avatar FROM mlsUser WHERE username LIKE :username";
		$statement = $pdo->prepare($query);

		//feed the search parameter to the placeholder in the template
		$username = "$username";
		$parameters = array("username" => $username);
		$statement->execute($parameters);

		//build an array of retrieved user profiles, as an SplFixedArray object
		//size of the SplFixedArray object set to the number of rows retrieved by the query
		$retrievedUsers = new SplFixedArray($statement->rowCount());

		//set fetch mode to retrieve each row as an array indexed by column name
		$statement->setFetchMode(PDO::FETCH_ASSOC);

		//while rows can still be retrieved from the result
		while($row = $statement->fetch() !== null) {
			try{
				//place the retrieved row into a new MlsUser object, and place that object into the array of retrieved users
				$user = new MlsUser($row["userId"], $row["avatar"], $row["username"]);
				$retrievedUsers[$retrievedUsers->key()] = $user;
				//advance the index in the SplFixedArray
				$retrievedUsers->next();
				//if an exception occurred, rethrow it
			}catch (Exception $exception){
				throw(new PDOException($exception->getMessage(), 0, $exception));
			}
		}
		//return the SplFixedArray of users
		return($retrievedUsers);
	}
}