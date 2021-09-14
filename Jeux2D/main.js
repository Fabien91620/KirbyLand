var config = {
    type: Phaser.AUTO,
    width: 700,
    height: 700,
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
var camPos;
var levelStart = 1920/2;
var estMort=false;
var gameover = false;
var pos =3600;
var doubleJump = false;
var jumped = false;
var mortText;
var score = 0;
var scoreText;
var hauteur = 3450;

function preload ()
{
    // Preload Background, Plateform et étoile	
	this.load.image('fond', 'Jeux2D/assets/Background/Sky/Sky1.png');
    this.load.image('fond1', 'Jeux2D/assets/Background/Sky/Sky2.png');
    this.load.image('platform', 'Jeux2D/assets/Background/platform/Platform.png');
    this.load.image('platformInvisible', 'Jeux2D/assets/Background/platform/Platform1.png');
    this.load.image('platformPic', 'Jeux2D/assets/Background/platform/Platform2.png');
    this.load.image('stars', 'Jeux2D/assets/Background/Stars/Star.png');
    
    // Preload Sritesheet Player

    this.load.spritesheet('dude','Jeux2D/assets/Player/Spritesheets/KirbySurPlace.png',
        { frameWidth: 23, frameHeight: 19 });
	this.load.spritesheet('dudePlace','Jeux2D/assets/Player/Spritesheets/KirbyRunLeft.png',
        { frameWidth: 23, frameHeight: 19 });
	this.load.spritesheet('DudeRunRight','Jeux2D/assets/Player/Spritesheets/KirbyRunRight.png',
        { frameWidth: 23, frameHeight: 19 });
}

function create ()
{	
    //Background
	fondCiel = this.add.image(1920/2, 1080, 'fond').setOrigin(0.5).setScale(1);
    fondCiel = this.add.image(1920/2, -4200, 'fond1').setOrigin(0.5).setScale(1);
    fondCiel = this.add.image(1920/2, -9480, 'fond1').setOrigin(0.5).setScale(1);
    fondCiel = this.add.image(1920/2, -14760, 'fond1').setOrigin(0.5).setScale(1);
    fondCiel = this.add.image(1920/2, -20040, 'fond1').setOrigin(0.5).setScale(1);
    
    //Plateform & Physique & étoiles
	platforms = this.physics.add.staticGroup();
	etoiles = this.physics.add.group();
	platformsPic = this.physics.add.staticGroup();
    platformsInvisible = this.physics.add.staticGroup();
	player = this.physics.add.sprite(levelStart, 3763, 'dude').setScale(2).setOrigin(0.5); //3763
	player.setBounce(0);	
	for(var i=0; i< 10; i++){
        var nb=random(1,100);
            if(nb > 25){
                var plateform =platforms.create(random(680,1250), pos, 'platform').setScale(0.12).refreshBody();
                if(random(0,100)<35){
                    etoiles.create(plateform.x,plateform.y-100, 'stars').setScale(0.02).setBounce(0.8);
                }
            }
            else{		
                platformsPic.create(random(680,1250), pos, 'platformPic').setScale(0.12).refreshBody();
            }
    pos-=random(100,200);
    }
    
    //Platform Invisible
    platformsInvisible.create(500, 4100, 'platformInvisible').setScale(1).refreshBody();
    platformsInvisible.create(800, 4100, 'platformInvisible').setScale(1).refreshBody();
    platformsInvisible.create(1100, 4100, 'platformInvisible').setScale(1).refreshBody();
    platformsInvisible.create(1300, 4100, 'platformInvisible').setScale(1).refreshBody();
	
    this.physics.add.collider(player, platformsInvisible);
	this.physics.add.collider(player, platforms);
	this.physics.add.collider(etoiles, platforms);
	this.physics.add.collider(player, platformsPic, Death,null, this);
	this.physics.add.collider(player, etoiles, Etoile,null, this);
    
    //Ajout du player et des spritesheets de mouvements			
	this.anims.create({
		key: 'left',
		frames: this.anims.generateFrameNumbers('dudePlace', { start: 0, end: 9 }),
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
    
    //Ajout de la camera
	camPos=this.physics.add.sprite(100, 180, 'dude').setScale(0).setOrigin(0.5);
    camPos.body.setGravityY(0);
	camPos.y=player.y;
	camPos.x=1920/2;
	this.cameras.main.startFollow(camPos, true);
    scoreText = this.add.text(700, player.y-320, 'score: 0', { fontSize: '90px', fill: '#FEDE31'}).setOrigin(0.5).setScale(0.4);
}

function update ()
{
    //Score
    scoreText.text = "score:"+score;
    scoreText.setPosition(700, hauteur -320);
    
	//Mort
	if(estMort){
        camPos.y=hauteur;
        player.anims.play('turn');  
        if(!gameover)
            mortText = this.add.text(1920/2, hauteur, 'Game Over', { fontSize: '90px', fill: '#FEDE31',align: "center"}).setOrigin(0.5);         
        gameover=true;
		return;
	}
    if(player.y < hauteur){
        hauteur = player.y;
    }
	if(player.y - 450 > hauteur){
        Death();
       
    }
    
    //Détruire les platforms
	Phaser.Actions.Call(platforms.getChildren(), function(plat){
		if(plat.y > player.y+600){
			Destroy(plat);
			ajoutPlateform();
		}
	},this);
	Phaser.Actions.Call(platformsPic.getChildren(), function(plat){
		if(plat.y > player.y+600){
			Destroy(plat);
			ajoutPlateform();
		}
	},this);
	
    //Ajout des parametres camera
	camPos.y= hauteur;
    
    if(player.y>3765)
		player.y=3765;
	
	if(player.x>1270)
		player.x=1270;
	
	if(player.x<640)
		player.x=640; 

    //Ajout des mouvement du player
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
	
    //Saut simple
	if(player.body.touching.down)
	{
        doubleJump=false;
        if(cursors.up.isDown && !jumped){
        jumped=true;
		player.setVelocityY(-400);
		player.anims.play('turn');
        }
	}
    //Double saut
    else{
        if(cursors.up.isDown && !doubleJump && !jumped){
        doubleJump=true;
        jumped=true;
		player.setVelocityY(-400);
		player.anims.play('turn');
        }
    }
    //désappuie de la touche de saut
    if(cursors.up.isUp){
        jumped=false;
    }
	//Décente
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
}
function Etoile(player, etoile){
    etoile.destroy();
    score+= 10;
    scoreText.setText("score:" + score);
}
function Death(){	
	if(estMort)
		return
	console.log("tu es mort");
	estMort=true;
	this.cameras.main.stopFollow();
	
	Phaser.Actions.Call(platformsPic.getChildren(), function(plat){
		plat.body.enable = false;
	},this);
	Phaser.Actions.Call(platforms.getChildren(), function(plat){
		plat.body.enable = false;
	},this);	
}
function Destroy(sprite){
	
	sprite.destroy();
}
function ajoutPlateform(){
    if(hauteur < 1000){
        var nb=random(1,100);
        if(nb > 25){
            platforms.create(random(680,1250), pos, 'platform').setScale(0.12).refreshBody();
        }
        else{
            platforms.create(random(680,1250), pos, 'platformPic').setScale(0.12).refreshBody();
        }
    }
    else if(hauteur < -1000){
        var nb=random(1,100);
        if(nb > 35){
            platforms.create(random(680,1250), pos, 'platform').setScale(0.12).refreshBody();
        }
        else{
            platforms.create(random(680,1250), pos, 'platformPic').setScale(0.12).refreshBody();
        }
    }
    else{
        var nb=random(1,100);
        if(nb > 15){
            platforms.create(random(680,1250), pos, 'platform').setScale(0.12).refreshBody();
        }
        else{
            platforms.create(random(680,1250), pos, 'platformPic').setScale(0.12).refreshBody();
        }
    }
	pos-=random(100,200);
}
function random(min, max){
	 return Math.random() * (max - min) + min;
}