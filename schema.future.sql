create table schedule(
	id int not null auto_increment primary key,
	start_date_at date,
	finish_date_at date,
	start_time_at time,
	finish_time_at time,
	n_repeat int, /* in days */
	k_repeat varchar(50), /* day, month, year */
	kind int, /* 1.- include, 2.- exclude */
	medic_id int,
	foreign key (medic_id) references medic(id)
);


create table signs(
	id int not null auto_increment primary key,
	title varchar(255),
	weight varchar(255), /* peso en kilo*/
	heart_rate varchar(255), /* frecuencia cardiaca */
	blood_pressure varchar(255), /* presion de la sangre :/ */
	temperature varchar(255), /* temperatura */
	pacient_id int,
	medic_id int,
	create_at datetime,
	foreign key (medic_id) references medic(id),
	foreign key (pacient_id) references pacient(id)
);
