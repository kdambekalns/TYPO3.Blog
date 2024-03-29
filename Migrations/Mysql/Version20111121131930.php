<?php
namespace TYPO3\FLOW3\Persistence\Doctrine\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration,
	Doctrine\DBAL\Schema\Schema;

/**
 * Adjust TYPO3.Blog tables to current FLOW3 (with fixed column naming)
 */
class Version20111121131930 extends AbstractMigration {

	/**
	 * @param Schema $schema
	 * @return void
	 */
	public function up(Schema $schema) {
		$this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql");
		
		$this->addSql("ALTER TABLE typo3_blog_domain_model_blog DROP FOREIGN KEY typo3_blog_domain_model_blog_ibfk_1");
		$this->addSql("DROP INDEX IDX_20C5DDD311FFD19F ON typo3_blog_domain_model_blog");
		$this->addSql("ALTER TABLE typo3_blog_domain_model_blog CHANGE flow3_resource_resource authorpicture VARCHAR(40) DEFAULT NULL");
		$this->addSql("ALTER TABLE typo3_blog_domain_model_blog ADD CONSTRAINT FK_14E2E3A0A2B9E27 FOREIGN KEY (authorpicture) REFERENCES typo3_flow3_resource_resource(flow3_persistence_identifier)");
		$this->addSql("CREATE INDEX IDX_14E2E3A0A2B9E27 ON typo3_blog_domain_model_blog (authorpicture)");

		$this->addSql("ALTER TABLE typo3_blog_domain_model_image DROP FOREIGN KEY typo3_blog_domain_model_image_ibfk_1");
		$this->addSql("DROP INDEX IDX_35D2479711FFD19F ON typo3_blog_domain_model_image");
		$this->addSql("ALTER TABLE typo3_blog_domain_model_image CHANGE flow3_resource_resource originalresource VARCHAR(40) DEFAULT NULL");
		$this->addSql("ALTER TABLE typo3_blog_domain_model_image ADD CONSTRAINT FK_FCEA402F4E59BB9C FOREIGN KEY (originalresource) REFERENCES typo3_flow3_resource_resource(flow3_persistence_identifier)");
		$this->addSql("CREATE INDEX IDX_FCEA402F4E59BB9C ON typo3_blog_domain_model_image (originalresource)");

		$this->addSql("ALTER TABLE typo3_blog_domain_model_comment DROP FOREIGN KEY typo3_blog_domain_model_comment_ibfk_1");
		$this->addSql("DROP INDEX IDX_7882EFEFBA5AE01D ON typo3_blog_domain_model_comment");
		$this->addSql("ALTER TABLE typo3_blog_domain_model_comment CHANGE blog_post post VARCHAR(40) DEFAULT NULL");
		$this->addSql("ALTER TABLE typo3_blog_domain_model_comment ADD CONSTRAINT FK_CAFA97C45A8A6C8D FOREIGN KEY (post) REFERENCES typo3_blog_domain_model_post(flow3_persistence_identifier)");
		$this->addSql("CREATE INDEX IDX_CAFA97C45A8A6C8D ON typo3_blog_domain_model_comment (post)");

		$this->addSql("ALTER TABLE typo3_blog_domain_model_post DROP FOREIGN KEY typo3_blog_domain_model_post_ibfk_1");
		$this->addSql("ALTER TABLE typo3_blog_domain_model_post DROP FOREIGN KEY typo3_blog_domain_model_post_ibfk_2");
		$this->addSql("ALTER TABLE typo3_blog_domain_model_post DROP FOREIGN KEY typo3_blog_domain_model_post_ibfk_3");
		$this->addSql("DROP INDEX IDX_BA5AE01D20C5DDD3 ON typo3_blog_domain_model_post");
		$this->addSql("DROP INDEX IDX_BA5AE01D35D24797 ON typo3_blog_domain_model_post");
		$this->addSql("DROP INDEX IDX_BA5AE01D72113DE6 ON typo3_blog_domain_model_post");
		$this->addSql("ALTER TABLE typo3_blog_domain_model_post CHANGE blog_blog blog VARCHAR(40) DEFAULT NULL, CHANGE blog_image image VARCHAR(40) DEFAULT NULL, CHANGE blog_category category VARCHAR(40) DEFAULT NULL");
		$this->addSql("ALTER TABLE typo3_blog_domain_model_post ADD CONSTRAINT FK_8E7DDE6EC0155143 FOREIGN KEY (blog) REFERENCES typo3_blog_domain_model_blog(flow3_persistence_identifier)");
		$this->addSql("ALTER TABLE typo3_blog_domain_model_post ADD CONSTRAINT FK_8E7DDE6EC53D045F FOREIGN KEY (image) REFERENCES typo3_blog_domain_model_image(flow3_persistence_identifier)");
		$this->addSql("ALTER TABLE typo3_blog_domain_model_post ADD CONSTRAINT FK_8E7DDE6E64C19C1 FOREIGN KEY (category) REFERENCES typo3_blog_domain_model_category(flow3_persistence_identifier)");
		$this->addSql("CREATE INDEX IDX_8E7DDE6EC0155143 ON typo3_blog_domain_model_post (blog)");
		$this->addSql("CREATE INDEX IDX_8E7DDE6EC53D045F ON typo3_blog_domain_model_post (image)");
		$this->addSql("CREATE INDEX IDX_8E7DDE6E64C19C1 ON typo3_blog_domain_model_post (category)");
	}

	/**
	 * @param Schema $schema
	 * @return void
	 */
	public function down(Schema $schema) {
		$this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql");
		
		$this->addSql("ALTER TABLE typo3_blog_domain_model_blog DROP FOREIGN KEY FK_14E2E3A0A2B9E27");
		$this->addSql("DROP INDEX IDX_14E2E3A0A2B9E27 ON typo3_blog_domain_model_blog");
		$this->addSql("ALTER TABLE typo3_blog_domain_model_blog CHANGE authorpicture flow3_resource_resource VARCHAR(40) DEFAULT NULL");
		$this->addSql("ALTER TABLE typo3_blog_domain_model_blog ADD CONSTRAINT typo3_blog_domain_model_blog_ibfk_1 FOREIGN KEY (flow3_resource_resource) REFERENCES typo3_flow3_resource_resource(flow3_persistence_identifier)");
		$this->addSql("CREATE INDEX IDX_20C5DDD311FFD19F ON typo3_blog_domain_model_blog (flow3_resource_resource)");

		$this->addSql("ALTER TABLE typo3_blog_domain_model_comment DROP FOREIGN KEY FK_CAFA97C45A8A6C8D");
		$this->addSql("DROP INDEX IDX_CAFA97C45A8A6C8D ON typo3_blog_domain_model_comment");
		$this->addSql("ALTER TABLE typo3_blog_domain_model_comment CHANGE post blog_post VARCHAR(40) DEFAULT NULL");
		$this->addSql("ALTER TABLE typo3_blog_domain_model_comment ADD CONSTRAINT typo3_blog_domain_model_comment_ibfk_1 FOREIGN KEY (blog_post) REFERENCES typo3_blog_domain_model_post(flow3_persistence_identifier)");
		$this->addSql("CREATE INDEX IDX_7882EFEFBA5AE01D ON typo3_blog_domain_model_comment (blog_post)");

		$this->addSql("ALTER TABLE typo3_blog_domain_model_image DROP FOREIGN KEY FK_FCEA402F4E59BB9C");
		$this->addSql("DROP INDEX IDX_FCEA402F4E59BB9C ON typo3_blog_domain_model_image");
		$this->addSql("ALTER TABLE typo3_blog_domain_model_image CHANGE originalresource flow3_resource_resource VARCHAR(40) DEFAULT NULL");
		$this->addSql("ALTER TABLE typo3_blog_domain_model_image ADD CONSTRAINT typo3_blog_domain_model_image_ibfk_1 FOREIGN KEY (flow3_resource_resource) REFERENCES typo3_flow3_resource_resource(flow3_persistence_identifier)");
		$this->addSql("CREATE INDEX IDX_35D2479711FFD19F ON typo3_blog_domain_model_image (flow3_resource_resource)");

		$this->addSql("ALTER TABLE typo3_blog_domain_model_post DROP FOREIGN KEY FK_8E7DDE6EC0155143");
		$this->addSql("ALTER TABLE typo3_blog_domain_model_post DROP FOREIGN KEY FK_8E7DDE6EC53D045F");
		$this->addSql("ALTER TABLE typo3_blog_domain_model_post DROP FOREIGN KEY FK_8E7DDE6E64C19C1");
		$this->addSql("DROP INDEX IDX_8E7DDE6EC0155143 ON typo3_blog_domain_model_post");
		$this->addSql("DROP INDEX IDX_8E7DDE6EC53D045F ON typo3_blog_domain_model_post");
		$this->addSql("DROP INDEX IDX_8E7DDE6E64C19C1 ON typo3_blog_domain_model_post");
		$this->addSql("ALTER TABLE typo3_blog_domain_model_post CHANGE blog blog_blog VARCHAR(40) DEFAULT NULL, CHANGE image blog_image VARCHAR(40) DEFAULT NULL, CHANGE category blog_category VARCHAR(40) DEFAULT NULL");
		$this->addSql("ALTER TABLE typo3_blog_domain_model_post ADD CONSTRAINT typo3_blog_domain_model_post_ibfk_1 FOREIGN KEY (blog_blog) REFERENCES typo3_blog_domain_model_blog(flow3_persistence_identifier)");
		$this->addSql("ALTER TABLE typo3_blog_domain_model_post ADD CONSTRAINT typo3_blog_domain_model_post_ibfk_2 FOREIGN KEY (blog_image) REFERENCES typo3_blog_domain_model_image(flow3_persistence_identifier)");
		$this->addSql("ALTER TABLE typo3_blog_domain_model_post ADD CONSTRAINT typo3_blog_domain_model_post_ibfk_3 FOREIGN KEY (blog_category) REFERENCES typo3_blog_domain_model_category(flow3_persistence_identifier)");
		$this->addSql("CREATE INDEX IDX_BA5AE01D20C5DDD3 ON typo3_blog_domain_model_post (blog_blog)");
		$this->addSql("CREATE INDEX IDX_BA5AE01D35D24797 ON typo3_blog_domain_model_post (blog_image)");
		$this->addSql("CREATE INDEX IDX_BA5AE01D72113DE6 ON typo3_blog_domain_model_post (blog_category)");
	}
}

?>