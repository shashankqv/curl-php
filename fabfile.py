from fabric.api import local




def test():
    local("./manage.py test my_app")


def commit():
    local("git add -p && git commit")

def push():
    local("git push")

def prepare_deploy():
    #test()
    commit()
    push()

