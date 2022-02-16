------------------------------------------------------------
--        Script Postgre 
------------------------------------------------------------



------------------------------------------------------------
-- Table: Personne
------------------------------------------------------------
CREATE TABLE public.Personne(
	idPersonne     SERIAL NOT NULL ,
	nom            VARCHAR (255)  ,
	prenom         VARCHAR (255)  ,
	adresseMail    VARCHAR (255)  ,
	motDePasse     VARCHAR (255)  ,
	bio            VARCHAR (2000)   ,
	photoProfil    VARCHAR (25)  ,
	note           INT   ,
	public         BOOL  NOT NULL ,
	nbSignalements INT   ,
	CONSTRAINT prk_constraint_Personne PRIMARY KEY (idPersonne)
)WITHOUT OIDS;


------------------------------------------------------------
-- Table: Article
------------------------------------------------------------
CREATE TABLE public.Article(
	idArticle        SERIAL NOT NULL ,
	titre            VARCHAR (255)  ,
	contenu          VARCHAR (2000)   ,
	date_publication DATE   ,
	nbLikes          INT   ,
	archive          BOOL   ,
	nbSignalements   INT   ,
	payant           BOOL   ,
	CONSTRAINT prk_constraint_Article PRIMARY KEY (idArticle)
)WITHOUT OIDS;


------------------------------------------------------------
-- Table: Categorie
------------------------------------------------------------
CREATE TABLE public.Categorie(
	idCategorie SERIAL NOT NULL ,
	titre       VARCHAR (255)  ,
	description VARCHAR (2000)   ,
	CONSTRAINT prk_constraint_Categorie PRIMARY KEY (idCategorie)
)WITHOUT OIDS;


------------------------------------------------------------
-- Table: image
------------------------------------------------------------
CREATE TABLE public.image(
	idImage SERIAL NOT NULL ,
	chemin  VARCHAR (355)  ,
	CONSTRAINT prk_constraint_image PRIMARY KEY (idImage)
)WITHOUT OIDS;


------------------------------------------------------------
-- Table: Hashtag
------------------------------------------------------------
CREATE TABLE public.Hashtag(
	idHashtag INT  NOT NULL ,
	intitule  VARCHAR (255)  ,
	CONSTRAINT prk_constraint_Hashtag PRIMARY KEY (idHashtag)
)WITHOUT OIDS;


------------------------------------------------------------
-- Table: role
------------------------------------------------------------
CREATE TABLE public.role(
	id       SERIAL NOT NULL ,
	intitule VARCHAR (255) NOT NULL ,
	CONSTRAINT prk_constraint_role PRIMARY KEY (id,intitule)
)WITHOUT OIDS;


------------------------------------------------------------
-- Table: appartient a
------------------------------------------------------------
CREATE TABLE public.appartient_a(
	idCategorie INT  NOT NULL ,
	idArticle   INT  NOT NULL ,
	CONSTRAINT prk_constraint_appartient_a PRIMARY KEY (idCategorie,idArticle)
)WITHOUT OIDS;


------------------------------------------------------------
-- Table: article favori
------------------------------------------------------------
CREATE TABLE public.article_favori(
	idArticle  INT  NOT NULL ,
	idPersonne INT  NOT NULL ,
	CONSTRAINT prk_constraint_article_favori PRIMARY KEY (idArticle,idPersonne)
)WITHOUT OIDS;


------------------------------------------------------------
-- Table: catégorie favorite
------------------------------------------------------------
CREATE TABLE public.categorie_favorite(
	idPersonne  INT  NOT NULL ,
	idCategorie INT  NOT NULL ,
	CONSTRAINT prk_constraint_categorie_favorite PRIMARY KEY (idPersonne,idCategorie)
)WITHOUT OIDS;


------------------------------------------------------------
-- Table: possède images
------------------------------------------------------------
CREATE TABLE public.possede_images(
	idArticle INT  NOT NULL ,
	idImage   INT  NOT NULL ,
	CONSTRAINT prk_constraint_possede_images PRIMARY KEY (idArticle,idImage)
)WITHOUT OIDS;


------------------------------------------------------------
-- Table: possède hashtags
------------------------------------------------------------
CREATE TABLE public.possede_hashtags(
	idArticle INT  NOT NULL ,
	idHashtag INT  NOT NULL ,
	CONSTRAINT prk_constraint_possede_hashtags PRIMARY KEY (idArticle,idHashtag)
)WITHOUT OIDS;


------------------------------------------------------------
-- Table: abonné à
------------------------------------------------------------
CREATE TABLE public.abonne_a(
	idPersonne   INT  NOT NULL ,
	idPersonne_1 INT  NOT NULL ,
	CONSTRAINT prk_constraint_abonne_a PRIMARY KEY (idPersonne,idPersonne_1)
)WITHOUT OIDS;


------------------------------------------------------------
-- Table: a pour role
------------------------------------------------------------
CREATE TABLE public.a_pour_role(
	idPersonne INT  NOT NULL ,
	id         INT  NOT NULL ,
	intitule   VARCHAR (255) NOT NULL ,
	CONSTRAINT prk_constraint_a_pour_role PRIMARY KEY (idPersonne,id,intitule)
)WITHOUT OIDS;


------------------------------------------------------------
-- Table: rediger article
------------------------------------------------------------
CREATE TABLE public.rediger_article(
	idPersonne INT  NOT NULL ,
	idArticle  INT  NOT NULL ,
	CONSTRAINT prk_constraint_rediger_article PRIMARY KEY (idPersonne,idArticle)
)WITHOUT OIDS;


------------------------------------------------------------
-- Table: commenter article
------------------------------------------------------------
CREATE TABLE public.commenter_article(
	idCommentaire    SERIAL NOT NULL ,
	contenu          VARCHAR (500)  ,
	date_publication DATE   ,
	nbSignalements   INT   ,
	idArticle        INT  NOT NULL ,
	idPersonne       INT  NOT NULL ,
	CONSTRAINT prk_constraint_commenter_article PRIMARY KEY (idArticle,idPersonne)
)WITHOUT OIDS;



ALTER TABLE public.appartient_a ADD CONSTRAINT FK_appartient_a_idCategorie FOREIGN KEY (idCategorie) REFERENCES public.Categorie(idCategorie);
ALTER TABLE public.appartient_a ADD CONSTRAINT FK_appartient_a_idArticle FOREIGN KEY (idArticle) REFERENCES public.Article(idArticle);
ALTER TABLE public.article_favori ADD CONSTRAINT FK_article_favori_idArticle FOREIGN KEY (idArticle) REFERENCES public.Article(idArticle);
ALTER TABLE public.article_favori ADD CONSTRAINT FK_article_favori_idPersonne FOREIGN KEY (idPersonne) REFERENCES public.Personne(idPersonne);
ALTER TABLE public.categorie_favorite ADD CONSTRAINT FK_categorie_favorite_idPersonne FOREIGN KEY (idPersonne) REFERENCES public.Personne(idPersonne);
ALTER TABLE public.categorie_favorite ADD CONSTRAINT FK_categorie_favorite_idCategorie FOREIGN KEY (idCategorie) REFERENCES public.Categorie(idCategorie);
ALTER TABLE public.possede_images ADD CONSTRAINT FK_possede_images_idArticle FOREIGN KEY (idArticle) REFERENCES public.Article(idArticle);
ALTER TABLE public.possede_images ADD CONSTRAINT FK_possede_images_idImage FOREIGN KEY (idImage) REFERENCES public.image(idImage);
ALTER TABLE public.possede_hashtags ADD CONSTRAINT FK_possede_hashtags_idArticle FOREIGN KEY (idArticle) REFERENCES public.Article(idArticle);
ALTER TABLE public.possede_hashtags ADD CONSTRAINT FK_possede_hashtags_idHashtag FOREIGN KEY (idHashtag) REFERENCES public.Hashtag(idHashtag);
ALTER TABLE public.abonne_a ADD CONSTRAINT FK_abonne_a_idPersonne FOREIGN KEY (idPersonne) REFERENCES public.Personne(idPersonne);
ALTER TABLE public.abonne_a ADD CONSTRAINT FK_abonne_a_idPersonne_1 FOREIGN KEY (idPersonne_1) REFERENCES public.Personne(idPersonne);
ALTER TABLE public.a_pour_role ADD CONSTRAINT FK_a_pour_role_idPersonne FOREIGN KEY (idPersonne) REFERENCES public.Personne(idPersonne);
ALTER TABLE public.a_pour_role ADD CONSTRAINT FK_a_pour_role_id FOREIGN KEY (id) REFERENCES public.role(id);
ALTER TABLE public.a_pour_role ADD CONSTRAINT FK_a_pour_role_intitule FOREIGN KEY (intitule) REFERENCES public.role(intitule);
ALTER TABLE public.rediger_article ADD CONSTRAINT FK_rediger_article_idPersonne FOREIGN KEY (idPersonne) REFERENCES public.Personne(idPersonne);
ALTER TABLE public.rediger_article ADD CONSTRAINT FK_rediger_article_idArticle FOREIGN KEY (idArticle) REFERENCES public.Article(idArticle);
ALTER TABLE public.commenter_article ADD CONSTRAINT FK_commenter_article_idArticle FOREIGN KEY (idArticle) REFERENCES public.Article(idArticle);
ALTER TABLE public.commenter_article ADD CONSTRAINT FK_commenter_article_idPersonne FOREIGN KEY (idPersonne) REFERENCES public.Personne(idPersonne);
