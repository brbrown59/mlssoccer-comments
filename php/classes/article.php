<?php

/**
 * An article on MLSsoccer.com
 *
 * This is the class for any of the articles on MLSSoccer.com
 * It contains the text of the article itself, in addition to the author and title
 *
 * @author Bradley Brown <tall.white.ninja@gmail.com>
 */

class Article{
	/**
	 * id for the article; this is the primary key
	 * @var int $articleId
	 */
	private $articleId;
	/**
	 * the author of the article
	 * @var string $author
	 */
	private $author;
	/**
	 * the actual text of the article itself
	 * @var string $text
	 */
	private $text;
	/**
	 * the title of the article
	 * @var string $title
	 */
	private $title;

	/**
	 * accessor method for the articleId
	 *
	 * @return mixed value of article Id
	 */
	public function getArticleId(){
		return ($this->articleId);
	}

	/**
	 * mutator method for the articleId
	 *
	 * @param mixed $newArticleId value of article ID
	 * @throws InvalidArgumentException if $newArticleId is not an integer
	 * @throws RangeException if $newArticleId is not positive
	 */
	public function setArticleId($newArticleId){
		//base case; if the new ArticleId is null, this is a new article with no mySQL ID
		if($newArticleId === null){
			$this->articleId = null;
			return;
		}

		//verify that the new ArticleId is a valid integer
		$newArticleId = filter_var($newArticleId, FILTER_VALIDATE_INT);
		if ($newArticleId === false){
			throw(new InvalidArgumentException("Article ID is not a valid integer"));
		}

		//verify that the new ID is positive
		if ($newArticleId <= 0){
			throw(new RangeException("Article ID is not positive"));
		}

		//convert the new ID to an integer and store
		$this->articleId = intval($newArticleId);
	}

	/**
	 * accessor method for the author
	 *
	 * @return string value of author
	 */
	public function getAuthor(){
		return($this->author);
	}

	/**
	 * mutator method for the author
	 *
	 * @param string $newAuthor value of the new author
	 * @throws InvalidArgumentException if $newAuthor
	 * @throws RangeException if $newAuthor is greater than 64 characters
	 */
	public function setAuthor($newAuthor){
		//verify that new author is secure
		$newAuthor = trim($newAuthor);
		$newAuthor = filter_var($newAuthor, FILTER_SANITIZE_STRING);
		//reject and throw exeception if the above failed
		if(empty($newAuthor) === false){
			throw(new InvalidArgumentException("Author name is either empty or insecure"));
		}
		//verify that the author name will fit in the database; throw exeption if it does not
		if(strlen($newAuthor) > 64){
			throw(new RangeException("Author name is too large"));
		}
		//store the new username
		$this->author = $newAuthor;
	}
}