var canvas, stage, context, preload,
	backCloud, cloud1, cloud2, cloud3,
    text1, text2, text2, text4,
    cogWheel, cogWheel2, scene2Cloud1, scene2Cloud2, scene2XervCloud,
    plan, arrow1, manage, arrow2, deploy, arrow3;

function init() {
	canvas = document.getElementById("canvas");
	stage = new createjs.Stage(canvas);
    context = canvas.getContext("2d");

    createjs.MotionGuidePlugin.install(createjs.Tween);

    preload = new createjs.LoadQueue(false);
	preload.on("complete", handleComplete);
	preload.loadManifest([
		{id: "BackCloud", src:"img/backCloud.png"},
		{id: "Cloud1", src:"img/cloudBlob1.png"},
		{id: "Cloud2", src:"img/cloudBlob2.png"},
        {id: "Cloud3", src:"img/cloudBlob3.png"},
        {id: "XervmonCloud", src:"img/xervmon.png"},
        {id: "CogWheel", src:"img/cogWheel.png"},
        {id: "CogWheel2", src:"img/cogWheel2.png"},
        {id: "Scene2Cloud1", src:"img/scene2Cloud1.png"},
        {id: "Scene2Cloud2", src:"img/scene2Cloud1.png"},
        {id: "Scene2XervCloud", src:"img/scene2XervCloud.png"},
        {id: "plan", src:"img/plan.png"},
        {id: "arrow1", src:"img/arrow.png"},
        {id: "arrow2", src:"img/arrow.png"},
        {id: "arrow3", src:"img/arrow.png"},
        {id: "manage", src:"img/manage.png"},
        {id: "deploy", src:"img/deploy.png"},
		]);
	stage.update();	
}

function handleComplete(event) {
	    backCloud = preload.getResult("BackCloud");
        cloud1 = preload.getResult("Cloud1");
        cloud2 = preload.getResult("Cloud2");
        cloud3 = preload.getResult("Cloud3"); 
        xervmonCloud = preload.getResult("XervmonCloud");
        cogWheel = preload.getResult("CogWheel");
        cogWheel2 = preload.getResult("CogWheel2");
        scene2Cloud1 = preload.getResult("Scene2Cloud1");
        scene2Cloud2 = preload.getResult("Scene2Cloud2");
        scene2XervCloud = preload.getResult("Scene2XervCloud");
        plan = preload.getResult("plan");
        arrow1 = preload.getResult("arrow1");
        arrow2 = preload.getResult("arrow2");
        arrow3 = preload.getResult("arrow3");
        manage = preload.getResult("manage");
        deploy = preload.getResult("deploy");

        createjs.Ticker.setFPS(60);
        createjs.Ticker.addEventListener("tick", tick);
        createjs.Ticker.useRAF = true;

        backCloud = new createjs.Bitmap(backCloud);
        cloud1 = new createjs.Bitmap(cloud1);
        cloud2 = new createjs.Bitmap(cloud2);
        cloud3 = new createjs.Bitmap(cloud3);
        xervmonCloud = new createjs.Bitmap(xervmonCloud);
        cogWheel = new createjs.Bitmap(cogWheel);
        cogWheel2 = new createjs.Bitmap(cogWheel2);
        scene2Cloud1 = new createjs.Bitmap(scene2Cloud1);
        scene2Cloud2 = new createjs.Bitmap(scene2Cloud2);
        scene2XervCloud = new createjs.Bitmap(scene2XervCloud);
        plan = new createjs.Bitmap(plan);
        arrow1 = new createjs.Bitmap(arrow1);
        arrow2 = new createjs.Bitmap(arrow2);
        arrow3 = new createjs.Bitmap(arrow3);
        manage = new createjs.Bitmap(manage);
        deploy = new createjs.Bitmap(deploy);
        
        cloud1.x = -600; cloud2.x = -600; cloud3.x = -600;
        cloud3.y = -100; cloud2.y = 10;
        cloud3.alpha = 0.8; cloud2.alpha = 0.8;
        
        text1 = new createjs.Text("Hybrid", "80px Segoe ui light", "#3082a1");
        text1.x = 305; text1.y = 750;
        text2 = new createjs.Text("Cloud", "80px Segoe ui light", "#3082a1");
        text2.x = 565; text2.y = 750;
        text3 = new createjs.Text("Management", "80px Segoe ui light", "#3082a1");
        text3.x = 805; text3.y = 750;
        text4 = new createjs.Text("Simplified", "80px Segoe ui light", "#3082a1");
        text4.x = 560; text4.y = 750;

        xervmonCloud.scaleX = xervmonCloud.scaleY = 0.7;
        xervmonCloud.x = canvas.width; xervmonCloud.y = (canvas.height/2 - 105);

        
        createjs.Tween.get(cloud1, {loop: true}, true).to({x:1500}, 70000);
        createjs.Tween.get(cloud2, {loop: true}, true).to({x:1500}, 50000);
        createjs.Tween.get(cloud3, {loop: true}, true).to({x:1500}, 30000);
        
        createjs.Tween.get(xervmonCloud, {loop: false}, true).wait(1000).to({x:(canvas.width/2 - 140)}, 1000, createjs.Ease.bounceOut).call(Text1);
            function Text1() {
                createjs.Tween.get(text1, {loop: false}, true).to({y:450}, 800, createjs.Ease.getBackOut(2)).call(Text2);   
            }
            function Text2() {
                createjs.Tween.get(text2, {loop: false}, true).to({y:450}, 900, createjs.Ease.getBackOut(2)).call(Text3);   
            }
            function Text3() {
                createjs.Tween.get(text3, {loop: false}, true).to({y:450}, 1000, createjs.Ease.getBackOut(2)).call(Text4);   
            }
            function Text4() {
                createjs.Tween.get(text4, {loop: false}, true).to({y:550}, 1100, createjs.Ease.getBackOut(2)).wait(1000).call(clearText);   
            }
        
        function clearText() {
            createjs.Tween.get(text1, {loop: false}, true).to({alpha:0}, 2000);
            createjs.Tween.get(text2, {loop: false}, true).to({alpha:0}, 2000);
            createjs.Tween.get(text3, {loop: false}, true).to({alpha:0}, 2000);
            createjs.Tween.get(text4, {loop: false}, true).to({alpha:0}, 2000);
            createjs.Tween.get(xervmonCloud, {loop: false}, true).to({alpha:0}, 2000).call(Scene2);
        }
        stage.addChild(backCloud, cloud1, cloud2, cloud3, xervmonCloud, text1, text2, text3, text4);
	}

function Scene2() {
        
        stage.removeChild(text1, text2, text3, text4, xervmonCloud);
        xervmonCloud = new createjs.Bitmap(xervmonCloud);
        
        createjs.Ticker.setFPS(60);
        createjs.Ticker.useRAF = true;
        
        var planText, manageText, deployText;
        planText = new createjs.Text("Plan", "40px Segoe ui", "#3082a1");
        planText.x = canvas.width/2-355; planText.y = canvas.height/2+440;
        manageText = new createjs.Text("Manage & Monitor", "40px Segoe ui", "#3082a1");
        manageText.x = canvas.width/2-325; manageText.y = canvas.height/2+450;
        deployText = new createjs.Text("Deploy", "40px Segoe ui", "#3082a1");
        deployText.x = canvas.width/2-55; deployText.y = canvas.height/2+450;
        
        scene2Cloud1.alpha = 0.8;
        scene2Cloud1.x = canvas.width; scene2Cloud1.y = canvas.height/2 - 100;
        scene2Cloud2.alpha = 0.6; scene2Cloud2.scaleX = scene2Cloud2.scaleY = 0.8;
        scene2Cloud2.x = -500; scene2Cloud2.y = canvas.height/2 - 50;
        scene2XervCloud.x = canvas.width/2; scene2XervCloud.y = canvas.height/2-100;  scene2XervCloud.regX=110; scene2XervCloud.regY=71; 
        scene2XervCloud.scaleX = scene2XervCloud.scaleY = 0; scene2XervCloud.alpha = 0;
        cogWheel.x=canvas.width/2+50; cogWheel.y=canvas.height/2+20; cogWheel.alpha=0;
        cogWheel.scaleX = cogWheel.scaleY = 0;   cogWheel.regX=35; cogWheel.regY=35;
        cogWheel2.x=canvas.width/2-10; cogWheel2.y=canvas.height/2+20; cogWheel2.alpha=0;
        cogWheel2.scaleX = cogWheel2.scaleY = 0;   cogWheel2.regX=25; cogWheel2.regY=25;
        
        plan.x=canvas.width/2-320; plan.y=canvas.height/2+100; plan.scaleX = plan.scaleY = 0; plan.regX=63; plan.regY=63;
        manage.x=canvas.width/2-160; manage.y=canvas.height/2+240; manage.scaleX = manage.scaleY = 0; manage.regX=63; manage.regY=63;
        deploy.x=canvas.width/2; deploy.y=canvas.height/2+100; deploy.scaleX = deploy.scaleY = 0; deploy.regX=63; deploy.regY=63;
        arrow1.y=canvas.height/2+120; arrow1.x=canvas.width/2-260; arrow1.alpha=0; arrow1.scaleX = arrow1.scaleY = 0.5; arrow1.rotation=40;
        arrow2.y=canvas.height/2+180; arrow2.x=canvas.width/2-140; arrow2.alpha=0; arrow2.scaleX = arrow2.scaleY = 0.5; arrow2.rotation=-40;
        arrow3.y=canvas.height/2+120; arrow3.x=canvas.width/2+70; arrow3.alpha=0; arrow3.scaleX = arrow3.scaleY = 0.5; arrow3.rotation=40;
        
        createjs.Tween.get(scene2XervCloud, {loop: false}, true).wait(1000).to({alpha:100, scaleX:1, scaleY:1}, 500, createjs.Ease.bounceOut);
        createjs.Tween.get(cogWheel, {loop: false}, true).wait(1500).to({alpha:100, scaleX:1, scaleY:1}, 500, createjs.Ease.bounceOut).wait(200).call(function() {
        createjs.Tween.get(cogWheel, {loop: true}, true).to({rotation:360}, 3000);
        });
        createjs.Tween.get(cogWheel2, {loop: false}, true).wait(1600).to({alpha:100, scaleX:1, scaleY:1}, 500, createjs.Ease.bounceOut).wait(200).call(function() {
        createjs.Tween.get(cogWheel2, {loop: true}, true).to({rotation:-360}, 2000);
        });
        createjs.Tween.get(scene2Cloud1, {loop: false}, true).to({x:canvas.width/2+150}, 1000, createjs.Ease.cubicInOut);
        createjs.Tween.get(scene2Cloud2, {loop: false}, true).to({x:canvas.width/2-350}, 1000, createjs.Ease.cubicInOut);
        
        createjs.Tween.get(plan, {loop: false}, true).wait(3000).to({scaleX:0.7, scaleY:0.7}, 500, createjs.Ease.bounceOut).call(function() {
            createjs.Tween.get(planText, {loop: false}, true).to({y:canvas.height/2+140}, 800, createjs.Ease.cubicInOut).call(function() {
                createjs.Tween.get(arrow1, {loop: false}, true).to({alpha:100}, 500, createjs.Ease.cubicInOut);    
            });   
        });
        createjs.Tween.get(manage, {loop: false}, true).wait(5000).to({scaleX:0.7, scaleY:0.7}, 500, createjs.Ease.bounceOut).call(function() {
            createjs.Tween.get(manageText, {loop: false}, true).to({y:canvas.height/2+280}, 800, createjs.Ease.cubicInOut).call(function() {
                createjs.Tween.get(arrow2, {loop: false}, true).to({alpha:100}, 500, createjs.Ease.cubicInOut);    
            });   
        });
        createjs.Tween.get(deploy, {loop: false}, true).wait(7000).to({scaleX:0.7, scaleY:0.7}, 500, createjs.Ease.bounceOut).call(function() {
            createjs.Tween.get(deployText, {loop: false}, true).to({y:canvas.height/2+140}, 800, createjs.Ease.cubicInOut).call(function() {
                createjs.Tween.get(arrow3, {loop: false}, true).to({alpha:100}, 500, createjs.Ease.cubicInOut);    
            });   
        });
        
        xervmonCloud.x = canvas.width/2; 
        cogWheel.scaleX = cogWheel.scaleY = 1;
        stage.addChild(xervmonCloud, cogWheel, scene2Cloud1, scene2Cloud2, scene2XervCloud, cogWheel, cogWheel2, plan, planText, arrow1, manage, manageText);
        stage.addChild(arrow2, deploy, deployText, arrow3);
    }

function tick() {
	stage.update();
}
        
