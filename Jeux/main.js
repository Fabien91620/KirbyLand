var config = {
    type: Phaser.AUTO,
    width: 1425,
    height: 800,
	physics: {
        default: 'arcade',
        arcade: {
            gravity: { y: 300 },
            debug: false
        }
    },
    scene: {
        preload: preload,
        create: create,
        update: update
    }
};

var player;
var sprite;
var game = new Phaser.Game(config);
var levelStart = 200; //200
var hauteur = 500;
var doubleJump = false;
var jumped = false;
var pos = 25000;
var pos1= 21000;
var camPos;
var levelFinish = 15800;
var largeur = 0;
var score = 0;
var scoreText;
var mort = false;
var perdu = false;
var gagne = false;
var gameover;
var win;
var winText;

function preload(){
    
    // Background & Plateforme
    this.load.image('background', 'Jeux/assets/Background/Sky/Sky.png');
    this.load.image('backgroundF', 'Jeux/assets/Background/Sky/SkyFinish.png');
    this.load.image('sol', 'Jeux/assets/Background/Platform/Platform.png');
    this.load.image('pic', 'Jeux/assets/Background/Platform/Platform2.png');
    this.load.image('etoile', 'Jeux/assets/Background/Stars/Star.png');
    
    // Player
    
    this.load.spritesheet('dude', 'Jeux/assets/Player/Spritesheets/KirbySurPlace.png',
        { frameWidth: 23, frameHeight: 19 });
    this.load.spritesheet('dudePlace','Jeux/assets/Player/Spritesheets/KirbyRunLeft.png',
        { frameWidth: 23, frameHeight: 19 });
	this.load.spritesheet('DudeRunRight','Jeux/assets/Player/Spritesheets/KirbyRunRight.png',
        { frameWidth: 23, frameHeight: 19 });
    
}

function create(){
    
    background = this.add.image(1425/2, 200,'background').setOrigin(0.5).setScale(1);
    background = this.add.image(2090, 200,'background').setOrigin(0.5).setScale(1);
    background = this.add.image(3515, 200,'background').setOrigin(0.5).setScale(1);
    background = this.add.image(4940, 200,'background').setOrigin(0.5).setScale(1);
    background = this.add.image(6365, 200,'background').setOrigin(0.5).setScale(1);
    background = this.add.image(7790, 200,'background').setOrigin(0.5).setScale(1);
    background = this.add.image(9215, 200,'background').setOrigin(0.5).setScale(1);
    background = this.add.image(10640, 200,'background').setOrigin(0.5).setScale(1);
    background = this.add.image(12065, 200,'background').setOrigin(0.5).setScale(1);
    background = this.add.image(13490, 200,'background').setOrigin(0.5).setScale(1);
    background = this.add.image(14915, 200,'background').setOrigin(0.5).setScale(1);
    background = this.add.image(15515, 200,'backgroundF').setOrigin(0.5).setScale(1);
    
    
    platforms = this.physics.add.staticGroup();
    platformsPic = this.physics.add.staticGroup();
    etoiles = this.physics.add.group();
    for(var i=0; i<55; i++){
        var nb = random(1, 100);
        if(nb > 35 ){
            var platform = platforms.create(pos, random(800, 800), 'sol').setScale(0.25).refreshBody();
            if(random(0,100)<35){
                etoiles.create(platform.x,platform.y-100, 'etoile').setScale(0.02).setBounce(0.8);
            }
        }
        else{
            var platform = platformsPic.create(pos, random(800, 800), 'pic').setScale(0.25).refreshBody();
        }
        pos-= random(300, 1000);
    }
    
    for(var i=0; i<55; i++){
        var nb1 = random(1, 100);
        if(nb1 > 35){
            var platform = platforms.create(pos1, random(600, 200), 'sol').setScale(0.2).refreshBody();
            if(random(0,100)<35){
                etoiles.create(platform.x,platform.y-100, 'etoile').setScale(0.02).setBounce(0.8);
            }
        }
        else{
            var platform = platformsPic.create(pos1, random(600, 200), 'pic').setScale(0.2).refreshBody();
        }
        pos1-= random(300, 500);
    }
    
    player = this.physics.add.sprite(levelStart, 200, 'dude').setScale(2).setOrigin(0.5);
    this.physics.add.collider(player, platforms);
    this.physics.add.collider(player, etoiles, Etoile, null, this);
    this.physics.add.collider(etoiles, platforms);
    this.physics.add.collider(player, platformsPic, Death, null, this);
    
    this.anims.create({
       key: 'left',
        frames: this.anims.generateFrameNumbers('dudePlace', {
            start: 0, end: 9}),
        frameRate: 30,
        repeat: -1
    });
    this.anims.create({
		key: 'turn',
		frames: this.anims.generateFrameNumbers('dude', { start: 0, end: 1 }),
		frameRate: 30,
		repeat: -1
	});
	this.anims.create({
		key: 'right',
		frames: this.anims.generateFrameNumbers('DudeRunRight', { start: 0, end: 9 }),
		frameRate: 30,
		repeat: -1
	});
    
    camPos = this.physics.add.sprite(100, 180, 'dude').setScale(0).setOrigin(0.5);
    camPos.body.setGravityY(0);
    camPos.y = 800/2;
    camPos.x = player.x;
    this.cameras.main.startFollow(camPos, true);
    scoreText = this.add.text(100, player.y -370, 'Score: 0', {
        fontSize: '90px', fill: '#FEDE31'}).setOrigin(0.5).setScale(0.4);
    
    
}

function update(){
    
    if(win){
        camPos.y = hauteur;
        player.anims.play('turn');
        if(!gagne){
            winText = this.add.text(15150, 900/2, 'Tu a Gagné ton Score est: '+ score, { fontSize:'70px', fill: '#FEDE31', align:"center"}).setOrigin(0.5);
        }
        gagne = true;
        return;
    }

    if(player.x > 15500){
        Win();
    }
    
    
    if(mort){
        camPos.y = hauteur;
        player.anims.play('turn');
        if(!perdu){
            gameover = this.add.text(largeur, 900/2, 'Game Over', { fontSize:'90px', fill: '#FEDE31', align:"center"}).setOrigin(0.5);
        }
        perdu = true;
        return;
    }
    
    if(player.y > 1000){
        Death();
    }
    
    cursors = this.input.keyboard.createCursorKeys();
    var onTheGround = player.body.touching.down;
    
	if (cursors.left.isDown)
	{
		player.setVelocityX(-300);

		player.anims.play('left', true);
	}
	else if (cursors.right.isDown)
	{
		player.setVelocityX(300);

		player.anims.play('right', true);
	}    
    else
	{
		player.setVelocityX(0);

		player.anims.play('turn');
	}
    if (player.body.touching.down){
        doubleJump = false;
        if (cursors.up.isDown && !jumped){
            jumped = true;
            player.setVelocityY(-400);
            player.anims.play('turn');
        }
    }
    else if (cursors.up.isDown && !doubleJump && !jumped){
        doubleJump=true;
        jumped=true;
		player.setVelocityY(-400);
		player.anims.play('turn');
    }
    if(cursors.up.isUp){
        jumped = false;
    }
    if(cursors.down.isDown)
	{
		if(player.body.touching.down)
		{
			
		}
		else
		{			
			player.setVelocityY(500);

			player.anims.play('turn');
		}
	}
    
    camPos.y = hauteur;
    if (player.x > 700){
        camPos.x = player.x;
    }
    else{
        camPos.x = 710;
    }
    if(player.x < 30){
        player.x = 30;
    }
    if(player.x >15150){
        camPos.x = 15150;
    }
    
    if(player.x >15150){
        scoreText.text = "Score:" + score;
        scoreText.setPosition(14550, 140);
    }
    else{
    scoreText.text = "Score:" + score;
    scoreText.setPosition(largeur -600, 140);
    }
    
    if(player.x < 650){
        largeur = 700
    }
    if(player.x > largeur){
        largeur = player.x;
    }
    
    Phaser.Actions.Call(platforms.getChildren(), function(plat){
        if(player.x > 14900){
            if(plat.x > player.x+600){
                Destroy(plat);
            }
        }
	},this);
	Phaser.Actions.Call(platformsPic.getChildren(), function(plat){
        if(player.x > 14900){
            if(plat.x > player.x+600){
                Destroy(plat);
            }
        }
	},this);
    
    
}
function Destroy(sprite){
	
	sprite.destroy();
}
function Win(){
    if(win){
        return
    }
    console.log('win')
    win = true;
}
function Death(){
    if(mort){
        return
    }
    mort = true;
    this.cameras.main.stopFollow();
    Phaser.Actions.Call(platformsPic.getChildren(), function(plat){
		plat.body.enable = false;
	},this);
	Phaser.Actions.Call(platforms.getChildren(), function(plat){
		plat.body.enable = false;
	},this);	
}
function Etoile(player, etoiles){
    etoiles.destroy();
    score += 10;
    scoreText.setText("Score:" + score)
}
function backgroundInfini(){
    background = this.add.image(1425/2, 700, 'background').setOrigin(0.5).setScale(1);
}
function random(min, max){
	 return Math.random() * (max - min) + min;
}