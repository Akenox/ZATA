<?php

class CreateTable
{

    public static function table_ok($table, $bdd){
        $req = $bdd->query("SHOW TABLES LIKE '$table'");
        $tableExists = $req !== false && $req->rowCount() > 0;
        if ($tableExists)
        {
            return true;
        }
        else{
            return false;
        }
    
    }

    public static function CreateTableCT($bdd)
    {
        if(!self::table_ok("infoct", $bdd))
        {
        Fonctions::RequeteSQLExecute($bdd,
        "CREATE TABLE infoct(
            ID int(11) NOT NULL,
            DateDernierCT date NOT NULL,
            DateComplementaireCT date NOT NULL,
            DateProchainCT date NOT NULL,
            IDVehicule int(11) NOT NULL
          ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;");
        
    
        Fonctions::RequeteSQLExecute($bdd,"ALTER TABLE infoct
                                            ADD PRIMARY KEY (ID),
                                            ADD KEY IDVehicule (IDVehicule);");
    
        Fonctions::RequeteSQLExecute($bdd,"ALTER TABLE infoct MODIFY ID int(10) NOT NULL AUTO_INCREMENT;");
        
        Fonctions::RequeteSQLExecute($bdd, "ALTER TABLE infoct ADD CONSTRAINT IDVehicule FOREIGN KEY (IDVehicule) REFERENCES vehicule (ID);");
    
        Fonctions::RequeteSQLExecute($bdd,"COMMIT;");
        }
    }



    public static function CreateTableCourroie($bdd)
    {
        if(!self::table_ok("Courroie", $bdd))
        {
        Fonctions::RequeteSQLExecute($bdd,
            "CREATE TABLE Courroie (
                ID int(10) NOT NULL,
                CadenceCourroie int(10) NOT NULL,
                KmDerniereCourroie  int(10) NOT NULL,
                CourroieARemplacer BOOLEAN NOT NULL,
                IDVehicule int(11) NOT NULL
    
                ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;");
        
    
        Fonctions::RequeteSQLExecute($bdd,"ALTER TABLE Courroie
                                            ADD PRIMARY KEY (ID),
                                            ADD KEY IDVehicule (IDVehicule);");
    
        Fonctions::RequeteSQLExecute($bdd,"ALTER TABLE Courroie MODIFY ID int(10) NOT NULL AUTO_INCREMENT;");
        
        Fonctions::RequeteSQLExecute($bdd, "ALTER TABLE Courroie ADD CONSTRAINT IDVehicule FOREIGN KEY (IDVehicule) REFERENCES vehicule (ID);");
    
        Fonctions::RequeteSQLExecute($bdd,"COMMIT;");
        }
    }

    public static function CreateTableVidange($bdd)
    {
        if(!self::table_ok("Vidange", $bdd))
        {
        Fonctions::RequeteSQLExecute($bdd,
            "CREATE TABLE Vidange (
                ID int(10) NOT NULL,
                CadenceVidange int(10) NOT NULL,
                KmDerniereVidange  int(10) NOT NULL,
                VidangeAFaire BOOLEAN NOT NULL,
                IDVehicule int(11) NOT NULL
    
                ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;");
        
    
        Fonctions::RequeteSQLExecute($bdd,"ALTER TABLE Vidange
                                            ADD PRIMARY KEY (ID),
                                            ADD KEY IDVehicule (IDVehicule);");
    
        Fonctions::RequeteSQLExecute($bdd,"ALTER TABLE Vidange MODIFY ID int(10) NOT NULL AUTO_INCREMENT;");
        
        Fonctions::RequeteSQLExecute($bdd, "ALTER TABLE Vidange ADD CONSTRAINT IDVehicule FOREIGN KEY (IDVehicule) REFERENCES vehicule (ID);");
    
        Fonctions::RequeteSQLExecute($bdd,"COMMIT;");
        }
    }

    public static function CreateTableIntervention($bdd)
    {
        if(!self::table_ok("Intervention", $bdd))
        {
            Fonctions::RequeteSQLExecute($bdd,
                "CREATE TABLE Intervention(
                    ID int(10) NOT NULL,
                    Date date NOT NULL,
                    Cout decimal NOT NULL,
                    Kilometre int(10),
                    Description TEXT,
                    IDVehicule int(11) NOT NULL
                    
                    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;");

            Fonctions::RequeteSQLExecute($bdd,"ALTER TABLE Intervention
                                                ADD PRIMARY KEY (ID),
                                                ADD KEY IDVehicule (IDVehicule);");

            Fonctions::RequeteSQLExecute($bdd,"ALTER TABLE Intervention MODIFY ID int(10) NOT NULL AUTO_INCREMENT;");
        
            Fonctions::RequeteSQLExecute($bdd, "ALTER TABLE Intervention ADD CONSTRAINT IDVehicule FOREIGN KEY (IDVehicule) REFERENCES vehicule (ID);");

            Fonctions::RequeteSQLExecute($bdd,"COMMIT;");
        }

    }
   


}






?>