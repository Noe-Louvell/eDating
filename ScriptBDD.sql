/*==============================================================*/
/* Nom de SGBD :  MySQL 5.0                                     */
/* Date de création :  10/02/2020 08:54:38                      */
/*==============================================================*/


drop table if exists Animal;

drop table if exists Citation;

drop table if exists Liker;

drop table if exists Matche;

drop table if exists Matcher;

drop table if exists Message;

drop table if exists Notification;

drop table if exists Race;

drop table if exists Signalement;

drop table if exists User;

/*==============================================================*/
/* Table : Animal                                               */
/*==============================================================*/
create table Animal
(
    ID_Animal            int not null auto_increment,
    ID_Race               int not null,
    ID_User                int not null,
    entente                bool,
    caractere             varchar(100),
    a_prenom            varchar(100),
    a_age                  date,
    primary key (ID_Animal)
);

/*==============================================================*/
/* Table : Citation                                             */
/*==============================================================*/
create table Citation
(
    ID_Citation          int not null auto_increment,
    Phrase              text,
    primary key (ID_Citation)
);

/*==============================================================*/
/* Table : Like                                               */
/*==============================================================*/
create table Liker
(
    ID_Liker              int not null auto_increment,
    ID_User       int not null,
    l_date               date,
    primary key (ID_Liker)
);

/*==============================================================*/
/* Table : Matche                                               */
/*==============================================================*/
create table Matche
(
    ID_Matche            int not null auto_increment,
    ma_date              date,
    primary key (ID_Matche)
);

/*==============================================================*/
/* Table : Matcher                                              */
/*==============================================================*/
create table Matcher
(
    ID_Matche            int not null,
    ID_User                 int not null,
    primary key (ID_Matche, ID_User)
);

/*==============================================================*/
/* Table : Message                                              */
/*==============================================================*/
create table Message
(
    ID_Message           int not null auto_increment,
    ID_User       int not null,
    UTI_ID_User   int not null,
    me_date              datetime,
    message        text,

    primary key (ID_Message)
);

/*==============================================================*/
/* Table : Notification                                         */
/*==============================================================*/
create table Notification
(
    ID_Notification      int not null auto_increment,
    ID_User       int not null,
    not_message          varchar(100),
    not_date             datetime,
    primary key (ID_Notification)
);

/*==============================================================*/
/* Table : Race    		*/
/*==============================================================*/
create table Race
(
    ID_Race              int not null auto_increment,
    r_nom                varchar(100),
    primary key (ID_Race)
);

/*==============================================================*/
/* Table : Signalement			*/
/*==============================================================*/
create table Signalement
(
    ID_Signalement    int not null auto_increment,
    ID_User                 int not null,
    UTI_ID_User          int not null,
    type         	ENUM ('Usurpation','Harcelement','Injure','Comportement douteu','Incitation a la haine'),
    commentaire       varchar(100),
    signaleur             varchar(100),
    signaler               varchar(100),
    S_DATE               datetime,
    primary key (ID_Signalement)
);

/*==============================================================*/
/* Table : User                                          */
/*==============================================================*/
create table User
(
    ID_User       int not null auto_increment,
    ID_Signalement       int,
    u_nom               varchar(100),
    u_prenom             varchar(100),
    sexe               ENUM ('Homme','Femme','Autre'),
    ville             varchar(100),
    telephone          varchar(100),
    age                varchar(100),
    passion            varchar(100),
    prefhum         ENUM ('Homme','Femme','Les deux'),
    satut           ENUM ('Marié.e','Veuf.ve','Célibataire'),
    parent          ENUM ('1 Enfant','2 Enfants','Non'),
    taille                   decimal,
    corpulence         ENUM ('Maigre','Normal','Fat AF'),
    cheuveux            ENUM ('Long','Mi long','Court','Long','Bouclés'),
    nationalite         varchar(100),
    religion              ENUM ('Non','Islam','Christianisme','Bouddhisme','Hindouisme','Judaïsme'),
    fumeur              ENUM ('Oui','Occasionnellement','Non'),
    description        varchar(255),
    email                 varchar(100),
    password           varchar(250),
    role               ENUM ('Utilisateur','Admin'),
        primary key (ID_User)
);

alter table Animal add constraint FK_POSSEDER foreign key (ID_User)
    references User (ID_User) on delete restrict on update restrict;

alter table Animal add constraint FK_QUALIFIER foreign key (ID_Race)
    references Race (ID_Race) on delete restrict on update restrict;

alter table "Liker" add constraint FK_AVOIR foreign key (ID_User)
    references User (ID_User) on delete restrict on update restrict;

alter table Matcher add constraint FK_MATCHER foreign key (ID_Matche)
    references Matche (ID_Matche) on delete restrict on update restrict;

alter table Matcher add constraint FK_MATCHER2 foreign key (ID_User)
    references User (ID_User) on delete restrict on update restrict;

alter table Message add constraint FK_ENVOYER foreign key (UTI_ID_User)
    references User (ID_User) on delete restrict on update restrict;

alter table Message add constraint FK_RECEVOIR foreign key (ID_User)
    references User (ID_User) on delete restrict on update restrict;

alter table Notification add constraint FK_NOTIFIER foreign key (ID_User)
    references User (ID_User) on delete restrict on update restrict;

alter table Signalement add constraint FK_DENONCER foreign key (ID_User)
    references User (ID_User) on delete restrict on update restrict;

alter table Signalement add constraint FK_SIGNALER foreign key (UTI_ID_User)
    references User (ID_User) on delete restrict on update restrict;

alter table User add constraint FK_DENONCER2 foreign key (ID_Signalement)
    references Signalement (ID_Signalement) on delete restrict on update restrict;

