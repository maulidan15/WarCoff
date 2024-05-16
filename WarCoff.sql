/*==============================================================*/
/* dbms name:      sybase sql anywhere 11                       */
/* created on:     06/05/2024 17:01:41                          */
/*==============================================================*/




/*==============================================================*/
/* table: barang                                                */
/*==============================================================*/
create table barang 
(
   id_barang            integer                        not null auto_increment,
   nama_barang          varchar(255)                   null,
   stok_barang          integer                        null,
   constraint pk_barang primary key (id_barang)
);

/*==============================================================*/
/* index: barang_pk                                             */
/*==============================================================*/
create unique index barang_pk on barang (
id_barang asc
);

/*==============================================================*/
/* table: transaksi                                             */
/*==============================================================*/
create table transaksi 
(
   id_transaksi         integer                        not null auto_increment,
   id_barang            integer                        null,
   id_user              integer                        null,
   tgl_transaksi        date                           null,
   jumlah_barang        integer                        null,
   constraint pk_transaksi primary key (id_transaksi)
);

/*==============================================================*/
/* index: transaksi_pk                                          */
/*==============================================================*/
create unique index transaksi_pk on transaksi (
id_transaksi asc
);

/*==============================================================*/
/* index: relationship_1_fk                                     */
/*==============================================================*/
create index relationship_1_fk on transaksi (
id_user asc
);

/*==============================================================*/
/* index: relationship_2_fk                                     */
/*==============================================================*/
create index relationship_2_fk on transaksi (
id_barang asc
);

/*==============================================================*/
/* table: "user"                                                */
/*==============================================================*/
create table user 
(
   id_user              integer                        not null auto_increment,
   email                varchar(255)                   null,
   password             varchar(255)                   null,
   nama                 varchar(255)                   null,
   role                 varchar(255)                   null,
   constraint pk_user primary key (id_user)
);

/*==============================================================*/
/* index: user_pk                                               */
/*==============================================================*/
create unique index user_pk on user (
id_user asc
);

alter table transaksi
   add constraint fk_transaks_relations_user foreign key (id_user)
      references user (id_user)
      on update restrict
      on delete restrict;

alter table transaksi
   add constraint fk_transaks_relations_barang foreign key (id_barang)
      references barang (id_barang)
      on update restrict
      on delete restrict;

