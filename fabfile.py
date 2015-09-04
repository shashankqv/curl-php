#from fabric.api import local
#from fabric.api import local, settings, abort
from __future__ import with_statement
from fabric.contrib.console import confirm
from fabric.api import *


#env.hosts = ['root@205.147.110.100']

def test():
    with settings(warn_only=True):
        result = local('./manage.py test my_app', capture=True)
    #local("./manage.py test my_app")
    if result.failed and not confirm("Tests failed. Continue anyway?"):
        abort("Aborting at user request.")


def commit():
    with settings(warn_only=True):
        result = local('git add -p && git commit', capture=True)

    if result.failed and not confirm("Commit failed. Continue anyway?"):
        abort("aborting as user request")
    #local("git add -p && git commit")

def push():
    local("git push")

def deploy():
    code_dir = '/root/test/curl-php'
    with settings(warn_only=True):
        if run("test -d %s" % code_dir).failed:
            run("git clone shashankqv@github:curl-php/.git %s" % code_dir)
    with cd(code_dir):
        run("git pull")

def prepare_deploy():
    #test()
    commit()
    push()
    deploy()

