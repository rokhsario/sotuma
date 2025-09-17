# Instructions to Push SOTUMA Project to GitHub

## Step 1: Open a new Command Prompt or PowerShell
- Press `Win + R`, type `cmd` or `powershell`, press Enter
- Navigate to your project: `cd C:\laragon\www\SOTUMA`

## Step 2: Run these commands one by one:

```bash
# Remove existing remote (if any)
git remote remove origin

# Add your GitHub repository
git remote add origin https://github.com/rokhsario/sotuma.git

# Check if remote is added correctly
git remote -v

# Push to GitHub (this will overwrite any existing content)
git push --set-upstream origin main --force
```

## Step 3: If you get authentication errors:

### Option A: Use Personal Access Token
1. Go to GitHub.com → Settings → Developer settings → Personal access tokens → Tokens (classic)
2. Generate new token with `repo` permissions
3. When prompted for password, use the token instead

### Option B: Use GitHub CLI
```bash
# Install GitHub CLI first, then:
gh auth login
git push --set-upstream origin main --force
```

## Step 4: Verify
- Go to https://github.com/rokhsario/sotuma
- You should see all your project files there

## If you still have issues:
- Make sure the repository exists on GitHub
- Check if it's public/private and you have the right permissions
- Try using SSH instead: `git remote set-url origin git@github.com:rokhsario/sotuma.git`
