<?php
require_once(dirname(dirname(__DIR__)) . "/lib/validate-date.php");

/**
 * A comment on MLSsoccer.com
 *
 * This is the class for a comment on MLSsoccer.com
 * It contains the text and time of the comment,
 * as well as information about the user who posted it and the article to which it was posted
 *
 *@author Bradley Brown <tall.white.ninja@gmail.com>
 **/
class Comment{
	/**
 	* id for the comment; this is the primary key
 	* @var int $commentId
 	**/
	private $commentId;
	/**
	 * id for the article to which this comment is posted; this is a foreign key
	 * @var int $articleId
	 **/
	private $articleId;
	/**
	 * id for the user who posted this comment; this is a foreign key
	 * @var int userId
	 **/
	private $userId;
	/**
	 * time at which this article was posted, in a DateTime object
	 * @var DateTime $time
	 */
	private $time;
	/**
	 * text of the posted comment itself
	 * @var string $text
	 **/
	private $text;

	/**
	 * Constructor method for a comment
	 *
	 * @param mixed $newCommentId value of the Comment Id
	 * @param int $newArticleId new value of Article Id
	 * @param int $newUserId new value of User ID
	 * @param mixed $newTime new value of time as either string, DateTime object, or null for the current time
	 * @param string $newText new value of the comment text
	 * @throws InvalidArgumentException if data types are not valid
	 * @throws RangeException if data values are out of bounds (strings that are too long, or negative integers)
	 * @throws Exception if some other exception is thrown
	 **/
	public function __construct($newCommentId, $newArticleId, $newUserId, $newTime, $newText){
		//call the class's mutators to set the given falues
		try{
			$this->setCommentId($newCommentId);
			$this->setArticleId($newArticleId);
			$this->setUserId($newUserId);
			$this->setTime($newTime);
			$this->setText($newText);
			//catch the exceptions that could be thrown by the mutators, including the generic exception
		} catch(InvalidArgumentException $invalidArgument){
			throw(new InvalidArgumentException ($invalidArgument->getMessage(), 0, $invalidArgument));
		} catch (RangeException $range){
			throw(new RangeException($range->getMessage(), 0, $range));
		} catch (Exception $exception){
			throw(new Exception($exception->getMessage(), 0, $exception));
		}
	}

	/**
	 * accessor method for the comment Id
	 *
	 * @return mixed value of comment Id
	 */
	public function getCommentId(){
		return($this->commentId);
	}

	/**
	 * mutator method for the comment Id
	 *
	 * @param mixed $newCommentId value of the comment Id
	 * @throws InvalidArgumentException if $newCommentId is not an integer
	 * @throws RangeException if $newCommentId is not positive
	 */
	public function setCommentId($newCommentId){
		//base case; the argument is null, this is a new comment with no ID in mySQL (yet)
		if($newCommentId === null){
			$this->commentId = null;
			return;
		}

		//verify that the comment ID is a valid integer
		$newCommentId = filter_var($newCommentId, FILTER_VALIDATE_INT);
		if ($newCommentId === false){
			throw(new InvalidArgumentException("Comment ID is not a valid integer"));
		}

		//verify that the comment ID is positive
		if ($newCommentId <= 0){
			throw(new RangeException("Comment ID is not positive"));
		}

		//convert the ID to an integer and store
		$this->commentId = intval($newCommentId);
	}

	/**
	 * accessor method for the article ID
	 *
	 * @return int value of article ID
	 **/
	public function getArticleId(){
		return($this->getArticleId());
	}

	/**
	 * mutator method for the article ID
	 *
	 * @param int $newArticleId new value of Article Id
	 * @throws InvalidArgumentException if $newArticleId is not an integer
	 * @throws RangeException if $newArticleId is not positive
	 */
	public function setArticleId($newArticleId){
		//verify that the ID is valid
		$newArticleId = filter_var($newArticleId, FILTER_VALIDATE_INT);
		if ($newArticleId === false){
			throw(new InvalidArgumentException("Article ID is not a valid integer"));
		}
		//verify that the ID is positive
		if ($newArticleId <= 0){
			throw(new RangeException("Article ID is not positive"));
		}
		//convert the Id to an integer and store
		$this->articleId = intval($newArticleId);
	}

	/**
	 * accessor method for the user ID
	 *
	 * @return int value of user ID
	 **/
	public function getUserId(){
		return($this->getUserId());
	}

	/**
	 * mutator method for the user ID
	 *
	 * @param int $newUserId new value of User ID
	 * @throws InvalidArgumentException if $newUserId is not an integer
	 * @throws RangeException if $newUserId is not positive
	 */
	public function setUserId($newUserId){
		//verify that the ID is valid
		$newUserId = filter_var($newUserId, FILTER_VALIDATE_INT);
		if ($newUserId === false){
			throw(new InvalidArgumentException("User ID is not a valid integer"));
		}
		//verify that the ID is positive
		if ($newUserId <= 0){
			throw(new RangeException("User ID is not positive"));
		}
		//convert the Id to an integer and store
		$this->userId = intval($newUserId);
	}

	/**
	 * accessor method for the comment time
	 *
	 * @return DateTime value of comment time
	 */
	public function getTime(){
		return($this->time);
	}

	/**
	 * mutator method for the comment time
	 *
	 * @param mixed $newTime new value of time as either string, DateTime object, or null for the current time
	 * @throws InvalidArgumentException if $newTime is not a valid object or string
	 * @throws RangeException if $newTime is a time and date that does not exist
	 * @throws Exception if some other exception is thrown
	 **/
	public function setTime($newTime){
		//base case: if the time is null, assign to the current time
		if($newTime === null){
			$this->time = new DateTime();
			return;
		}

		//validate using the function defined in validate-date.php, and store if it works
		try{
			$newTime = validateDate($newTime);
		} catch(InvalidArgumentException $invalidArgument){
			throw(new InvalidArgumentException($invalidArgument->getMessage(), 0, $invalidArgument));
		} catch(RangeException $range){
			throw(new RangeException($range->getMessage(), 0, $range));
		} catch(Exception $exception){
			throw(new Exception($exception->getMessage(), 0, $exception));
		}
		$this->time = $newTime;
	}

	/**
	 * accessor method for the comment text
	 *
	 * @return string value of comment text
	 **/
	public function getText(){
		return($this->text);
	}

	/**
	 * mutator method for the comment text
	 *
	 * @param string $newText new value of the comment text
	 * @throws InvalidArgumentException if $newText is not a string or insecure
	 * @throws RangeException if $newText is greater than 512 characters
	 */
	public function setText($newText){
		//verify that new text is secure
		$newText = trim($newText);
		$newText = filter_var($newText, FILTER_SANITIZE_STRING);
		//reject and throw exeception if the above failed
		//empty case is okay
		if(empty($newText) === true){
			throw(new InvalidArgumentException("Comment text is empty or insecure"));
		}
		//verify that the article text will fit in the database; throw exeption if it does not
		if(strlen($newText) > 512){
			throw(new RangeException("Comment text is too large"));
		}
		//store the new username
		$this->text = $newText;
	}
}