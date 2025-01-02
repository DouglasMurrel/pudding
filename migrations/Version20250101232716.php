<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250101232716 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE article DROP FOREIGN KEY FK_23A0E6612469DE2');
        $this->addSql('ALTER TABLE category DROP FOREIGN KEY FK_64C19C1727ACA70');
        $this->addSql('ALTER TABLE category DROP FOREIGN KEY FK_64C19C1A977936C');
        $this->addSql('DROP TABLE category');
        $this->addSql('DROP INDEX IDX_23A0E6612469DE2 ON article');
        $this->addSql('ALTER TABLE article ADD tree_root INT DEFAULT NULL, ADD parent_id INT DEFAULT NULL, ADD lvl INT NOT NULL, ADD rgt INT NOT NULL, CHANGE category_id lft INT NOT NULL');
        $this->addSql('ALTER TABLE article ADD CONSTRAINT FK_23A0E66A977936C FOREIGN KEY (tree_root) REFERENCES article (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE article ADD CONSTRAINT FK_23A0E66727ACA70 FOREIGN KEY (parent_id) REFERENCES article (id) ON DELETE CASCADE');
        $this->addSql('CREATE INDEX IDX_23A0E66A977936C ON article (tree_root)');
        $this->addSql('CREATE INDEX IDX_23A0E66727ACA70 ON article (parent_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE category (id INT AUTO_INCREMENT NOT NULL, tree_root INT DEFAULT NULL, parent_id INT DEFAULT NULL, name VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, slug VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, lft INT NOT NULL, lvl INT NOT NULL, rgt INT NOT NULL, INDEX IDX_64C19C1727ACA70 (parent_id), INDEX IDX_64C19C1A977936C (tree_root), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE category ADD CONSTRAINT FK_64C19C1727ACA70 FOREIGN KEY (parent_id) REFERENCES category (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE category ADD CONSTRAINT FK_64C19C1A977936C FOREIGN KEY (tree_root) REFERENCES category (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE article DROP FOREIGN KEY FK_23A0E66A977936C');
        $this->addSql('ALTER TABLE article DROP FOREIGN KEY FK_23A0E66727ACA70');
        $this->addSql('DROP INDEX IDX_23A0E66A977936C ON article');
        $this->addSql('DROP INDEX IDX_23A0E66727ACA70 ON article');
        $this->addSql('ALTER TABLE article ADD category_id INT NOT NULL, DROP tree_root, DROP parent_id, DROP lft, DROP lvl, DROP rgt');
        $this->addSql('ALTER TABLE article ADD CONSTRAINT FK_23A0E6612469DE2 FOREIGN KEY (category_id) REFERENCES category (id)');
        $this->addSql('CREATE INDEX IDX_23A0E6612469DE2 ON article (category_id)');
    }
}
