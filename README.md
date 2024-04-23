# somethingtodo.today

A mostly-offline social media app

## Local development

1. `docker compose up -d` - run the database
1. `symfony server:start` - start the server
1. Visit http://localhost:8000/

## TODO:
1. Fix the CSS
1. Figure out deployment and deploy
    1. Create and deploy database (RDS?)
    1. Generate database secrets and store
    1. Deploy app (EKS? EC2?)
    1. Deploy secrets https://symfony.com/doc/current/configuration/secrets.html#deploy-secrets-to-production
    1. Update main user with ROLE_ADMIN
        1. `symfony console dbal:run-sql "UPDATE users set roles='[\"ROLE_ADMIN\"]' where id = 1"`
    1. Lock down registration form
    1. Come up with a workflow/action for continuous deploy
1. Confirm cloudflare captcha working
1. Populate the database with some starter prompts (see below)
1. Start circulating

## Some starter prompts:
Make an open faced sandwich
Pinch your cheek with your thumb inside your mouth
clean out your belly button lint
Hum two bars of Yankee Doodle Dandy into your sock
Drink water with a spoon
write yourself a nice note in lipstick on the mirror
make yourself a peanut butter banana concoction
Imagine a freight train plowing through a marshmallow barrier
