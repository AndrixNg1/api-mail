### ✅ Ton `README.md` amélioré avec badges

````markdown
# 📨 API Mail – Formulaire de Contact en PHP

Une API simple et sécurisée en PHP utilisant **PHPMailer** pour envoyer des emails depuis un formulaire de contact. Idéal pour les portfolios, sites vitrines ou tout projet statique souhaitant une solution d'envoi d'email sans backend complexe.

---

## 🚀 Fonctionnalités

- ✅ Envoi d’emails via SMTP (Gmail, OVH, etc.)
- ✅ Sécurité renforcée (validation, sanitation, .env)
- ✅ Support des requêtes CORS
- ✅ Interface HTML de test incluse

---

## 📦 Installation

### 1. Cloner le projet

```bash
git clone https://github.com/AndrixNg1/api-mail.git
cd api-mail
````

### 2. Installer les dépendances PHP

Assurez-vous d’avoir [Composer](https://getcomposer.org/) installé :

```bash
composer install
```

### 3. Créer le fichier `.env`

Crée un fichier `.env` à la racine avec le contenu suivant :

```env
SMTP_HOST=smtp.gmail.com
SMTP_USER=ton.email@gmail.com
SMTP_PASS=ton_mot_de_passe_application
SMTP_PORT=587
MAIL_TO=adresse.reception@gmail.com
```

> 🔐 Utilise un mot de passe d’application Gmail (ne jamais utiliser ton mot de passe principal).

---

## 🧪 Interface de test

Tu peux tester l’envoi de mail avec le fichier `test.html` fourni.

### Étapes :

1. Lance un serveur local :

```bash
php -S localhost:8000
```

2. Ouvre [http://localhost:8000/test.html](http://localhost:8000/test.html) dans ton navigateur.
3. Remplis le formulaire et clique sur **Envoyer**.

---

## 📡 Requête API

### ➤ Endpoint

```
POST /contact.php
```

### ➤ Corps de la requête (JSON)

```json
{
  "name": "Jean Dupont",
  "email": "jean@example.com",
  "subject": "Demande de devis",
  "message": "Bonjour, j'aimerais un devis pour votre service."
}
```

### ➤ Réponse (succès)

```json
{
  "success": true,
  "message": "Email envoyé avec succès."
}
```

---

## ✅ Sécurité

* ✔ Champs requis validés (`filter_var`, `htmlspecialchars`)
* ✔ Infos sensibles protégées avec `.env`
* ✔ En-têtes CORS configurés uniquement pour des domaines spécifiques
* ✔ Logs d’erreurs serveur (pas d’erreurs sensibles affichées au client)

---

## 🙋‍♂️ Contribution

Tu peux proposer des améliorations ou signaler un bug :

* Crée une [Issue](https://github.com/AndrixNg1/api-mail/issues)
* Ou propose une Pull Request

---

## 📄 Licence

Ce projet est sous licence **MIT** — libre à l’usage personnel et commercial.

---

**Développé avec ❤️ par [AndrixNg1](https://github.com/AndrixNg1)**

```
