<?php
namespace Admin\App\Repository;

use App\Repository\Repository;

class CompanyRepository extends Repository
{
    public function showcredits()
    {
        $query = $this->pdo->prepare("SELECT credits FROM company WHERE id = 1;");
        $query->execute();

        $companycreditinfo = $query->fetch(\PDO::FETCH_ASSOC);

        $companycredit = $companycreditinfo["credits"];
        return $companycredit;
    }

    public function updateCredits($creditsUpdated)
    {
        $query = $this->pdo->prepare("UPDATE company SET credits = :credits WHERE id = 1;");

        $query->bindValue(":credits", $creditsUpdated, $this->pdo::PARAM_INT);
        $query->execute();
    }
}
