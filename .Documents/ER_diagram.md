# ER図

```mermaid
---
title: Application Entity Relationship Diagrams
---
erDiagram
    users {
        bigint id PK
        string name "ユーザー名"
        string email UK "アカウントID"
        string password "パスワード"
    }

    members {
        bigint id PK
        references user FK
        references library FK
        enum role "役割(一般会員, 司書, オーナー)"
    }

    libraries {
        bigint id PK
        string name "図書館名"
        string identification_code "図書館識別コード"
    }

    books {
        bigint id PK
        references library FK
        string name "書籍名"
    }


    book_stocks {
        references book FK
        int max_stocks "貸出中含む所蔵数"
        int current_stocks "現在の在庫数"
    }

    borrowed_history {
        bigint id PK
        references user FK "貸出者"
        references book FK "貸出図書"
        timestamp lended_at "貸出日"
        timestamp return_at "返却日"
    }

    users ||--o{ members: "1人のユーザーは複数の図書館に所属する"
    members }o--|| libraries: "1人のユーザーは複数の図書館に所属する"
    libraries ||--o{ books: "図書館は複数の本を持つ"

    users ||--o{ borrowed_history: "ユーザーは複数の貸出履歴が存在する"
    books ||--o{ borrowed_history: "図書は何回でも貸出履歴が存在する"
    books ||--|| book_stocks: "図書は在庫数の情報を持つ"
```
