from fabric.api import local


def prepare_deploy():
    local("git add -p && git commit")
    local("git push")
