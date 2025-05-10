# API Contact - Projet PHP

## Description

Cette API PHP permet à un utilisateur d'envoyer un message de contact via un formulaire. Elle utilise **PHPMailer** pour envoyer l'email au destinataire spécifié (par exemple, l'administrateur ou une adresse pré-configurée). Les utilisateurs doivent envoyer une requête POST avec des données JSON, et l'API enverra l'email avec les informations fournies.

## Fonctionnalités

- Envoi d'un email contenant les informations du contact (nom, email, sujet, message).
- Utilisation de **PHPMailer** pour l'envoi sécurisé d'emails via SMTP (exemple avec Gmail).
- Validation des champs nécessaires (nom, email, sujet, message).
- Réponse API sous forme JSON pour indiquer le succès ou l'échec de la demande.

## Prérequis

Avant d'exécuter l'API, vous devez avoir les éléments suivants :

- PHP 7.0+ installé sur votre serveur.
- Composer pour la gestion des dépendances (PHPMailer).
- Un serveur SMTP configuré (ex: Gmail) pour l'envoi d'emails.
- Un dépôt GitHub ou un environnement de déploiement comme **Railway** ou un serveur local.

## Installation

### 1. Cloner le projet

Clonez ce dépôt dans un dossier sur votre serveur ou votre machine locale :

```bash
git clone https://github.com/ton_utilisateur/ton_projet.git
cd ton_projet
