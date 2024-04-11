# PHP Little Messenger - PLM

Script PHP minimalista para um painel de recados (mural) para ser usado em qualquer site.

## TODO

- [x] Iniciar com algo bem básico e testar;

- [ ] Transformar em API JSON;

- [ ] Permitir texto com formatação (\*bold*, \_italic_, -strikethrough-);

- [ ] Permitir anexar arquivo (imagem, pdf, etc) com restrição de tamanho;

- [ ] Admin com "ping" automático no navegador (setTimeout|tick);

- [ ] Manter a simplicidade extrema para facilitar a instalação em qualquer serviço de **'back'** da internet.

## Banco de Dados (MySql)

```sql
-- USERS
CREATE TABLE `users` (
  `user_id` bigint(20) NOT NULL,
  `user_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

ALTER TABLE `users`
  MODIFY `user_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

INSERT INTO `users` (`user_id`, `user_name`) VALUES
  (1, 'Joe Doe'),
  (2, 'Jon Doe'),
  (3, 'Joy Doe');

-- MESSAGES
CREATE TABLE `messages` (
  `user_from` bigint(20) NOT NULL,
  `user_to` bigint(20) NOT NULL,
  `date_send` datetime NOT NULL DEFAULT current_timestamp(),
  `date_read` datetime DEFAULT NULL,
  `message` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

ALTER TABLE `messages`
  ADD PRIMARY KEY (`user_from`, `user_to`, `date_send`),
  ADD KEY `date_read` (`date_read`);
```