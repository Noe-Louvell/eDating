/*==============================================================*/
/* Nom de SGBD :  MySQL 5.0                                     */
/* Date de création :  31/01/2020 14:25:02                      */
/*==============================================================*/


drop table if exists ADMIN;

drop table if exists ANIMAL;

drop table if exists CITATION;

drop table if exists COUPDC;

drop table if exists MESSAGE;

drop table if exists NOTIFICATION;

drop table if exists RACE;

drop table if exists SIGNALEMENT;

drop table if exists UTILISATEUR;

/*==============================================================*/
/* Table : ADMIN                                                */
/*==============================================================*/
create table ADMIN
(
    ID_ADMIN             int not null auto_increment,
    EMAIL_ADMIN          varchar(100),
    MDP_ADMIN            varchar(100),
    PSEUDO_ADMIN         varchar(10),
    primary key (ID_ADMIN)
);

/*==============================================================*/
/* Table : ANIMAL                                               */
/*==============================================================*/
create table ANIMAL
(
    ID_ANIMAL            int not null auto_increment,
    ID_RACE              int not null,
    ID_UTILISATEUR       int not null,
    A_ENTENTE            bool,
    A_DESCRIPTION        varchar(100),
    A_PRENOM             varchar(100),
    A_AGE                date,
    primary key (ID_ANIMAL)
);

/*==============================================================*/
/* Table : CITATION                                             */
/*==============================================================*/
create table CITATION
(
    ID_CITATION          int not null auto_increment,
    PHRASE               varchar(100),
    primary key (ID_CITATION)
);

/*==============================================================*/
/* Table : COUPDC                                               */
/*==============================================================*/
create table COUPDC
(
    ID_COUPDC            int not null auto_increment,
    ID_UTILISATEUR       int not null,
    UTILI                varchar(25),
    primary key (ID_COUPDC)
);

/*==============================================================*/
/* Table : MESSAGE                                              */
/*==============================================================*/
create table MESSAGE
(
    ID_MESSAGE           int not null auto_increment,
    ID_UTILISATEUR       int not null,
    UTI_ID_UTILISATEUR   int not null,
    ME_DATE              datetime,
    ME_CONTENUE          varchar(250),
    primary key (ID_MESSAGE)
);

/*==============================================================*/
/* Table : NOTIFICATION                                         */
/*==============================================================*/
create table NOTIFICATION
(
    ID_NOTIFICATION      int not null auto_increment,
    ID_UTILISATEUR       int not null,
    NOT_MESSAGE          varchar(100),
    NOT_DATE             datetime,
    primary key (ID_NOTIFICATION)
);

/*==============================================================*/
/* Table : RACE                                                 */
/*==============================================================*/
create table RACE
(
    ID_RACE              int not null auto_increment,
    R_NOM                varchar(100),
    primary key (ID_RACE)
);

/*==============================================================*/
/* Table : SIGNALEMENT                                          */
/*==============================================================*/
create table SIGNALEMENT
(
    ID_SIGNALEMENT       int not null auto_increment,
    ID_ADMIN             int,
    ID_UTILISATEUR       int not null,
    UTI_ID_UTILISATEUR   int not null,
    TYPE                 ENUM ('Usurpation','Harcelement','Injure','Comportement douteu','Incitation a la haine'),
    COMMENTAIRE          varchar(100),
    SIGNALEUR            varchar(100),
    SIGNALER             varchar(100),
    S_DATE               datetime,
    primary key (ID_SIGNALEMENT)
);

/*==============================================================*/
/* Table : UTILISATEUR                                          */
/*==============================================================*/
create table UTILISATEUR
(
    ID_UTILISATEUR       int not null auto_increment,
    ID_SIGNALEMENT       int,
    U_NOM                varchar(100),
    U_PRENOM             varchar(100),
    U_SEXE               ENUM ('Homme','Femme','Autre'),
    U_VILLE              varchar(100),
    U_TELEPHONE          char(10),
    U_AGE                varchar(100),
    U_PASSION            varchar(100),
    U_PREFHUMAIN         ENUM ('Homme','Femme','Les deux'),
    U_STATUT             ENUM ('Marié.e','Veuf.ve','Célibataire'),
    U_PARENT             ENUM ('1 Enfant','2 Enfants','Non'),
    U_TAILLE             decimal,
    U_CORPULANCE         ENUM ('Maigre','Normal','Fat AF'),
    U_CHEVEUX            ENUM ('Long','Mi long','Court','Long','Bouclés'),
    U_NATIONALITE        varchar(100),
    U_RELIGION           ENUM ('Islam','Christianisme','Bouddhisme','Hindouisme','Judaïsme'),
    U_FUMEUR             ENUM ('Oui','Occasionnellement','Non'),
    U_DESCRIPTION        varchar(255),
    U_EMAIL              varchar(100),
    U_MDP                varchar(100),
    primary key (ID_UTILISATEUR)
);

alter table ANIMAL add constraint FK_POSSEDER foreign key (ID_UTILISATEUR)
    references UTILISATEUR (ID_UTILISATEUR) on delete restrict on update restrict;

alter table ANIMAL add constraint FK_QUALIFIER foreign key (ID_RACE)
    references RACE (ID_RACE) on delete restrict on update restrict;

alter table COUPDC add constraint FK_MATCHER foreign key (ID_UTILISATEUR)
    references UTILISATEUR (ID_UTILISATEUR) on delete restrict on update restrict;

alter table MESSAGE add constraint FK_ENVOYER foreign key (UTI_ID_UTILISATEUR)
    references UTILISATEUR (ID_UTILISATEUR) on delete restrict on update restrict;

alter table MESSAGE add constraint FK_RECEVOIR foreign key (ID_UTILISATEUR)
    references UTILISATEUR (ID_UTILISATEUR) on delete restrict on update restrict;

alter table NOTIFICATION add constraint FK_NOTIFIER foreign key (ID_UTILISATEUR)
    references UTILISATEUR (ID_UTILISATEUR) on delete restrict on update restrict;

alter table SIGNALEMENT add constraint FK_CONSULTER foreign key (ID_ADMIN)
    references ADMIN (ID_ADMIN) on delete restrict on update restrict;

alter table SIGNALEMENT add constraint FK_DENONCER foreign key (ID_UTILISATEUR)
    references UTILISATEUR (ID_UTILISATEUR) on delete restrict on update restrict;

alter table SIGNALEMENT add constraint FK_SIGNALER foreign key (UTI_ID_UTILISATEUR)
    references UTILISATEUR (ID_UTILISATEUR) on delete restrict on update restrict;

alter table UTILISATEUR add constraint FK_DENONCER2 foreign key (ID_SIGNALEMENT)
    references SIGNALEMENT (ID_SIGNALEMENT) on delete restrict on update restrict;

