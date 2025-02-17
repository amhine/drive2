<?php
class Utilisateur {
    private $db;

    public function __construct(Database $database) {
        $this->db = $database;
    }

    public function signup($nom, $email, $password, $role_id = 2) {
        // Vérifier si l'email existe déjà
        $check_email = $this->db->query("SELECT id_user FROM utilisateur WHERE email = '$email'");
        if($check_email->rowCount() > 0) {
            return "Cet email existe déjà";
        }

        // Vérifier la force du mot de passe
        if(strlen($password) < 6) {
            return "Le mot de passe doit contenir au moins 8 caractères";
        }

        $password_hash = password_hash($password, PASSWORD_DEFAULT);

        try {
            $sql = "INSERT INTO utilisateur (nom_user, email, password, id_role) 
                    VALUES ('$nom', '$email', '$password_hash', $role_id)";
            $this->db->query($sql);
            return "Inscription réussie";
        } catch(PDOException $e) {
            return "Erreur lors de l'inscription: " . $e->getMessage();
        }
    }

    public function connexion($email, $password) {
        $sql = "SELECT * FROM utilisateur WHERE email = '$email'";
        $result = $this->db->query($sql);
        
        if($row = $result->fetch(PDO::FETCH_ASSOC)) {
            if(password_verify($password, $row['password'])) {
                session_start();
                $_SESSION['id_user'] = $row['id_user'];
                $_SESSION['id_role'] = $row['id_role'];
                $_SESSION['nom_user'] = $row['nom_user'];
                return "Connexion réussie";
            }
            return "Mot de passe incorrect";
        }
        return "Email non trouvé";
    }



    public function countRole($roleName) {
        $sql = "SELECT COUNT(*) AS role_count 
                FROM utilisateur u 
                INNER JOIN role r ON u.id_role = r.id_role 
                WHERE r.nom_role = ?";
        $stmt = $this->db->prepare($sql); 
        $stmt->execute([$roleName]);      
    
        if ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            return $row['role_count'];
        }
        return 0;
    }
    
    
}
?>