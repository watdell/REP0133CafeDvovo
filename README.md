Claro! Aqui está o texto com os `'` substituídos por `` ` ``:

---

# REP0133CafeDvovo
Projetos da turma 0133 de Técnico de Informática Senac CEP Conselheiro Lafaiete

## Primeiros passos para começar a usar o git (assumindo que você já o tem baixado):
### Configurar o username e o email
- Execute o seguinte comando no git bash:
```
git config --global user.name "Seu Username"
git config --global user.email seu@email.com
```

### Comandos para obter ajuda do git:
```
git help {comando}
git {comando} --help
man git- {comando}
```

### Inicializar um repositório local
- Dentro do diretório da pasta do projeto, execute o seguinte comando:
```
git init
```

### Adicionar arquivos para commit:
- Usando o seguinte comando, você irá adicionar quais arquivos deseja commitar:
```
git add nome_do_arquivo.txt
```
- dica: se você substituir o nome_do_arquivo.txt para apenas um ponto (.), você irá adicionar TODOS os arquivos de uma vez:
```
git add .
```
- Porém, há arquivos que você não vai querer commitar, como arquivos contendo dependências de projeto e até mesmo senhas e usuários de banco de dados, para ignorar esses arquivos, basta criar um arquivo chamado .gitignore e dentro dele escrever o nome dos arquivos que deseja ignorar ao commitar

### Commitando para o repositório local
- Com o seguinte comando, você irá commitar todos os arquivos selecionados no git add:
```
git commit -m "mensagem do commit"
```
- Não se esqueça de deixar uma mensagem curta e objetiva do motivo do seu commit
- Outra coisa, tenha em mente que este commit será direcionado para a branch que você estiver selecionado, mais em frente terá o comando para selecionar outra branch

### Obtendo os status do git
- É possível obter alguns status do git para visualizar quais arquivos estão selecionados, quais sofreram mudanças, quais estão prontos para serem commitados, etc:
```
git status
```

### Resetando uma alteração
- Em qualquer fase, você pode querer desfazer alguma coisa. Aqui, veremos algumas ferramentas básicas para desfazer modificações que você fez. Cuidado, porque você não pode desfazer algumas dessas mudanças. Essa é uma das poucas áreas no Git onde você pode perder algum trabalho se fizer errado.
- Para voltar ao último commit:
```
git reset --hard HEAD~1
```
- Para voltar ao último commit e mantém os últimos arquivos no Stage:
```
git reset --soft HEAD~1
```
- Volta para o commit com a hash XXXXXXXXXXX:
```
git reset --hard XXXXXXXXXXX
```
> Recuperando commit apagado pelo git reset
- Para visualizar os hashs:
```
git reflog
```
- E para aplicar:
```
git merge {hash}
```

### Git Branch
- Criando uma nova Branch:
```
git branch testing
```
- Para alterar a branch atual (importante):
```
git checkout testing
```

### Git Merge
- Suponha que você decidiu que o trabalho na tarefa #53 está completo e pronto para ser feito o merge no branch master. Para fazer isso, você fará o merge do seu branch iss53, bem como o merge do branch hotfix de antes. Tudo que você tem a fazer é executar o checkout do branch para onde deseja fazer o merge e então rodar o comando git merge:
```
git checkout master
git merge iss53
```

### Resolvendo conflitos de merge
- Se você quer usar uma ferramenta gráfica para resolver esses problemas, você pode executar o seguinte comando que abre uma ferramenta visual de merge adequada e percorre os conflitos:
```
git mergetool
```

### Histórico de Commits
- Depois que você tiver criado vários commits, ou se clonou um repositório com um histórico de commits existente, você provavelmente vai querer ver o que aconteceu. A ferramenta mais básica e poderosa para fazer isso é o comando:
```
git log
```

### Clonando o repositório remoto
- Para obter os arquivos que estão no repositório remoto, basta executar o comando:
```
git clone <repo>
```
- Para obter os arquivos do REPO133CafeDvovo:
```
git clone https://github.com/watdell/REP0133CafeDvovo.git
```

### Conexão com o repositório remoto (REPO133CafeDvovo)
- Para criar uma conexão com o repositório remoto, basta executar o comando:
```
git remote add <name> <url>
```
- normalmente, costuma-se usar o name como origin:
```
git remote add origin https://github.com/watdell/REP0133CafeDvovo.git
```
- Pode ser que ele peça para você fazer login no github, mas isso só irá acontecer uma vez

### Git fetch
- Para pegar dados dos seus projetos remotos, você pode executar:
```
git fetch origin
```
- Esse comando vai até o projeto remoto e pega todos os dados que você ainda não tem. Depois de fazer isso, você deve ter referências para todos os branches desse remoto, onde você pode fazer o merge ou inspecionar a qualquer momento.

### Git pull
- Incorpora as alterações de um repositório remoto no branch atual. Em seu modo padrão, git pull é uma abreviação para git fetch seguido de git merge FETCH_HEAD. Por exemplo, se eu estiver em uma branch chamada develop e quiser atualizar caso haja atualizações remotamente:
```
git pull origin develop
```
- Uma boa prática é executar este comando a cada começo de dia de produção, para ter certeza de que o seu repositório local está atualizado

### Git push
- O git push é o comando em que você transfere commits a partir do seu repositório local para um repositório remoto. É a contrapartida do git fetch, que busca importações e comprometem as agências locais, utilizando o git push as exportações comprometem as filiais remotas. Para fazer isso, você executa git push [nome_do_repositório_remoto] [nome_da_sua_branch_local], que vai tentar fazer com que o [nome_do_repositório_remoto] receba a sua branch [nome_da_sua_branch_local] contendo todos seus commits com alterações. Por exemplo:
```
git push origin develop
```

---

Agora todos os `'` foram substituídos por `` ` ``. Se precisar de mais ajustes ou ajuda, é só falar!
