# Incident
## Mode opératoir 
Récole d'idd de co
Analyse Archi 
Desactivation des AV
Consultation de donnée (si ça arrive et quand on le découvre, remonté l'info des que possible)

## Timeline

### 14 mai 
premiere activité : analyse et prise d'information par le potentiel premier acteur (Acces Broker) => connexions au VPN suspectes (Heures et Location)

### 20 mai 
- Désactivation des AV
- Altération des données de backups  

### 20 aouts 
Déployage de l'arsenal d'attaque
Utilisation de WinCat
Consultation de donné ciblé (Documents d'idd, contrats, ...)
Propagation de LockBitBlack (Encryption des données => Ransomware)

## Analyse 
Attaque opportuniste du au manque d'xp de l'attaque donc possiblement non ciblé pour le CPAS

- Collecte des datas (Durs et volatile)
=> Infra détruite 
=> Reconstruction de coeurs et backups
=> Création de la VM de Jean Dupont (Ne devrais pas être autorisé)
=> Mot de passe trop faible
=> VPN tres permissif => donne un acces a toute les ressources 
=> Infra veillissante et personnel pas formé

# Organisation Globale
## 1ere étape 
- Mise en place cellule de crise (mise en place rapide et prendre des initatives directement)
- Appel a d'autre intervenant 
- Rassurer les médias et les clients
- Contacter les autorités hiérachique et les parteners 
- Contrôler la communication (Assurer le bons racord entre tous les collaborateur et les employés de la société)

## Mesure de continuité 
- Recréation des boites emails
- Mise a dispotion de smartphone neuf et numéro
- Réstauration du service et des machines pour les employés (juste pas sur le réseau CPAS)
- Donnés sur des clés USB distribué

## Mesure de Restauration
- Presque rien
- Backup niveau 2
- Restau des comptes user et admin

## Mesure d'amélioration 
- Mise en place EDR
- Remanier le VPN (ajout de rules)
- MFA activer pour les machines
- Cloisement réseau 
- Mise en place de 37 firewalls sur tous le reseau en étoile
- Développement des outils collaboratifs 
- Sensibilisation du personnel 


# Forensic 
## Methodologie incident response
- Travail en ammont (Organisation de l'opération, procédure préfaite, criticité de l'impact)
- Detection et analyse (Alertes, communication de victime)
- Contenir l'incident (Débranchez carte réseau / isoler le réseau)
- Eradiquer la menace et récup des données sans altération
- Elaborer des procédure / opération pour contrer ce genre d'incident

## Artéfact
- Connexion au VPN
- Logs d'antivirus 
- Logs systèmes (Windows, Unix, Mac)
- Hyperviseur
- Matériel physique (Disque, ram)

## Qu'en faire 
Logs => Splunk: ElasticSearch, ... 
Disque => Autopsy
Mémoire => Autopsy et volatility

## Technologie d'analyse 
- Récolte de logs => AD timeline (récolte les données d'activation)
- Création de timeline => Zimmerman tools
- Data triage et parsing => Zimmerman tools 
- Analyse de data => SIEM, autopsy, AD timeline, sandbox (Fam + kape)