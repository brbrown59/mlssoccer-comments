<?php
require_once(dirname(dirname(__DIR__)) . "/lib/php/date-utils.php");

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
}