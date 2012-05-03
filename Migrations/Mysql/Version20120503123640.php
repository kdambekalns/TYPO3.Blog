<?php
namespace TYPO3\FLOW3\Persistence\Doctrine\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration,
	Doctrine\DBAL\Schema\Schema;

/**
 * Make columns non-nullable and add unique indexes.
 */
class Version20120503123640 extends AbstractMigration {

	/**
	 * @param Schema $schema
	 * @return void
	 */
	public function up(Schema $schema) {
		$this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql");

		$this->addSql("ALTER TABLE typo3_blog_domain_model_comment CHANGE date date DATETIME NOT NULL, CHANGE emailaddress emailaddress VARCHAR(255) NOT NULL");
		$this->addSql("ALTER TABLE typo3_blog_domain_model_post CHANGE date date DATETIME NOT NULL");

		$this->addSql("CREATE UNIQUE INDEX flow3_identity_typo3_blog_domain_model_category ON typo3_blog_domain_model_category (name)");
		$this->addSql("CREATE UNIQUE INDEX flow3_identity_typo3_blog_domain_model_comment ON typo3_blog_domain_model_comment (date, author)");
		$this->addSql("CREATE UNIQUE INDEX flow3_identity_typo3_blog_domain_model_post ON typo3_blog_domain_model_post (title, date)");
	}

	/**
	 * @param Schema $schema
	 * @return void
	 */
	public function down(Schema $schema) {
		$this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql");

		$this->addSql("ALTER TABLE typo3_blog_domain_model_comment CHANGE date date DATETIME DEFAULT NULL, CHANGE emailaddress emailaddress VARCHAR(255) DEFAULT NULL");
		$this->addSql("ALTER TABLE typo3_blog_domain_model_post CHANGE date date DATETIME DEFAULT NULL");

		$this->addSql("DROP INDEX flow3_identity_typo3_blog_domain_model_category ON typo3_blog_domain_model_category");
		$this->addSql("DROP INDEX flow3_identity_typo3_blog_domain_model_comment ON typo3_blog_domain_model_comment");
		$this->addSql("DROP INDEX flow3_identity_typo3_blog_domain_model_post ON typo3_blog_domain_model_post");
	}
}

?>