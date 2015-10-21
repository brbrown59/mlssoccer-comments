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

	/*
	 * accessor method for the articleId
	 *
	 * @return mixed value of article Id
	 */
	public function getArticleId(){
		return ($this->articleId);
	}
}